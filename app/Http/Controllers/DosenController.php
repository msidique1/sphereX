<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Request as ModelsRequest;

class DosenController extends Controller {
    public function index(): View {
        $dosen = auth()->user()->dosen;
        $kelas = $dosen ? $dosen->kelas()->get() : collect();
        $mahasiswa = Mahasiswa::all()->count();
        $request = ModelsRequest::all();
        
        $dosenAvaibility = $dosen && $kelas->isNotEmpty() ? 'Aktif' : 'Tidak';

        return view(
            'dosen.dashboard',
            [
                'breadcrumb' => 'Dashboard',
                'mahasiswa' => $mahasiswa,
                'requestModel' => $request ? $request->count() : '0',
                'dosenAvaibility' => $dosenAvaibility,
                'kelas' => $kelas,
            ]
        );
    }

    public function mahasiswaManageView() : View {
        $dosen = auth()->user()->dosen;
        $mahasiswa = Mahasiswa::where('kelas_id', $dosen->kelas_id)->paginate(5);

        return view('dosen.management-mahasiswa', [
            'breadcrumb' => 'Mahasiswa Management',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function daftarMahasiswaView(): View {
        $mahasiswa = Mahasiswa::with('kelas')->paginate(5);

        return view('dosen.daftar-mahasiswa', [
            'breadcrumb' => 'Daftar Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function requestEditView(): View {
        if(auth()->check() && auth()->user()->role === 'dosen') {
            $dosen = auth()->user()->dosen;

            $editRequest = ModelsRequest::where('kelas_id', $dosen->kelas_id)
            ->paginate(5);

            return view('dosen.request-manage', [
                'breadcrumb' => 'Request Action Management',
                'editRequest' => $editRequest,
            ]);
        } else {
            return abort(403, 'Unauthorized action');
        }
    }

    public function addEditMahasiswaView($id = null): View {
        $mahasiswa = $id ? Mahasiswa::find($id) : null;

        return view('dosen.add-edit-mahasiswa', [
            'breadcrumb' => $id ? 'Edit Mahasiswa' : 'Tambah Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function storeMahasiswa(Request $request) {
        $validatedData = $this->validateMahasiswa($request);

        if(auth()->check() && auth()->user()->role === 'dosen') {
            $dosen = auth()->user()->dosen;

            if($validatedData['kelas_id'] !== $dosen->kelas_id) {
                return redirect()->back()->withErrors([
                    'kelas_id' => 'Anda bukan Wali Kelas dari kelas yang dipilih!',
                ]);
            }

            $validatedData['user_id'] = auth()->id();

            if (Mahasiswa::where('nim', $request->nim)->exists()) {
                return redirect()->back()->withErrors([
                    'duplicate' => 'Mahasiswa dengan NIM yang sama sudah tersedia.'])->withInput();
            }

            Mahasiswa::create($validatedData);
    
            session()->flash('notify', 'Mahasiswa added successfully!');
            session()->flash('type', 'success');
    
            return redirect()->route('dosen.management-mahasiswa');
        } else {
            return redirect()->back()->withErrors([
                'user_id' => 'User tidak memiliki hak akses untuk ini'
            ]);
        }
    }
    
    public function updateMahasiswa(Request $request, $id) {
        $validatedData = $this->validateMahasiswa($request, $id);
        $mahasiswa = Mahasiswa::find($id);

        if(auth()->check() && auth()->user()->role == 'dosen') {
            $dosen = auth()->user()->dosen;

            if($mahasiswa->kelas_id !== $dosen->kelas_id) {
                return abort(403, 'Unauthorized action, tidak dapat mengubah mahasiswa dari kelas lain');
            }

            $mahasiswa->update($validatedData);
        
            session()->flash('notify', 'Mahasiswa updated successfully!');
            session()->flash('type', 'success');
        
            return redirect()->route('dosen.management-mahasiswa');
        } else {
            return redirect()->back()->withErrors([
                'user_id', 'User tidak memiliki akses untuk ini.'
            ]);
        }
    }

    public function deleteMahasiswa($id) {
        $mahasiswa = Mahasiswa::find($id);

        if(auth()->check() && auth()->user()->role == 'dosen') {
            $dosen = auth()->user()->dosen;

            if($mahasiswa->kelas_id !== $dosen->kelas_id) {
                return abort(403, 'Unauthorized action, tidak dapat mengubah mahasiswa dari kelas lain');
            }

            Mahasiswa::findOrFail($id)->delete();

            session()->flash('notify', 'Mahasiswa deleted successfully!');
            session()->flash('type', 'success');

            return redirect()->route('dosen.management-mahasiswa');
        } else {
            return redirect()->back()->withErrors([
                'user_id', 'User tidak memiliki akses untuk aksi ini.'
            ]);
        }
    }
    
    private function validateMahasiswa(Request $request, $id = null) {
        return $request->validate([
            'name' => 'required|string|max:255',
            'nim' => [
                'required',
                'numeric',
                'max_digits:20',
                'unique:mahasiswa,nim' . ($id ? ",$id" : ''),
            ],
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);
    }

    public function handleEditRequest(Request $request, $id, $action) {
        $editRequest = ModelsRequest::find($id);

        if(auth()->check() && auth()->user()->role == 'dosen') {
            $dosen = auth()->user()->dosen;
            $mahasiswa = Mahasiswa::find($editRequest->mahasiswa_id);

            if($mahasiswa->kelas_id !== $dosen->kelas_id) {
                return abort(403, 'Unauthorized action, tidak dapat mengubah mahasiswa dari kelas lain');
            }

            if ($action == 'approve') {
                $mahasiswa->update(['edit' => true]);

                session()->flash('notify', 'Request approved and data updated successfully!');
            } elseif ($action == 'reject') {
                session()->flash('notify', 'Request rejected successfully!');
            } else {
                return redirect()->back()->withErrors(['action' => 'Invalid action']);
            }

            $editRequest->save();

            $editRequest->delete();

            session()->flash('type', 'success');

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['user_id' => 'User tidak memiliki akses untuk ini.']);
        }
    }
}
