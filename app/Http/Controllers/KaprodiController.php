<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaprodiController extends Controller {
    public function index(): View {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $kelas = Kelas::all();

        return view(
            'kaprodi.dashboard',
            [
                'breadcrumb' => 'Dashboard',
                'mahasiswa' => $mahasiswa,
                'dosen' => $dosen,
                'kelas' => $kelas,
            ]
        );
    }

    public function dosenView(): View {
        $dosen = Dosen::orderBy('created_at', 'desc')->paginate(5);

        return view('kaprodi.management-dosen', [
            'breadcrumb' => 'Manajemen Dosen',
            'dosen' => $dosen,
        ]);
    }

    public function kelasView(): View {
        $kelas = Kelas::orderBy('created_at', 'desc')->paginate(5);

        return view('kaprodi.management-kelas', [
            'breadcrumb' => 'Manajemen Kelas',
            'kelas' => $kelas,
        ]);
    }

    public function showMahasiswa(): View {
        $mahasiswa = Mahasiswa::with('kelas')->paginate(5);

        return view('kaprodi.show-mahasiswa', [
            'breadcrumb' => 'Daftar Mahasiswa',
            'kelas' => $mahasiswa,
        ]);
    }

    public function interfaceAddEditDosen($id = null) {
        $dosen = $id ? Dosen::find($id) : null;

        return view('kaprodi.add-edit-dosen', [
            'breadcrumb' => $id ? 'Edit Dosen' : 'Tambah Dosen',
            'dosen' => $dosen,
        ]);
    }

    public function interfaceManageKelas($id = null) {
        $kelas = $id ? Kelas::find($id) : null;

        return view('kaprodi.add-edit-kelas', [
            'breadcrumb' => $id ? 'Edit Kelas' : 'Tambah Kelas',
            'kelas' => $kelas,
        ]);
    }

    public function plottingOption(): View {
        $dosenWithoutKelas = Dosen::doesntHave('kelas')->get();
        $kelas = Kelas::with(['dosen', 'mahasiswa'])->paginate(5);

        return view('kaprodi.plotting', [
            'breadcrumb' => 'Plotting Manajemen',
            'kelas' => $kelas,
            'dosenWithoutKelas' => $dosenWithoutKelas,
        ]);
    }

    public function plotDetailView($type) {
        if($type === 'dosen') {
            $data = [
                'type' => $type,
                'breadcrumb' => 'Plotting Dosen',
                'dosen' => Dosen::all(),
                'kelas' => Kelas::all(),
            ];
        } elseif ($type === 'mahasiswa') {
            $data = [
                'type' => $type,
                'breadcrumb' => 'Plotting Mahasiswa',
                'mahasiswa' => Mahasiswa::all(),
                'kelas' => Kelas::all(),
            ];
        } else {
            abort(404, "Invalid Type");
        }

        return view('kaprodi.partials.plot-detail', $data);
    }

    public function plotDosen(Request $request) {
        $request->validate([
            'dosen_id' => [
                'required',
                'exists:dosen,id'
            ],
            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],
        ]);

        $dosen = Dosen::find($request->request_id);
        $kelas = Kelas::find($request->kelas_id);

        if ($kelas->dosen()->exists()) {
            session()->flash('notify', 'Kelas sudah memiliki dosen, tidak bisa memetakan dosen ke kelas ini!');
            session()->flash('type', 'error');
            return redirect()->route('kaprodi.plotting');
        }

        $dosen->kelas()->associate($kelas);
        $dosen->save();

        session()->flash('notify', 'Dosen berhasil dipetakan ke kelas!');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.plotting');
    }

    public function plotMahasiswa(Request $request) {
        $request->validate([
            'mahasiswa_id' => [
                'required',
                'exists:mahasiswa,id'
            ],
            'kelas_id' => [
                'required',
                'exists:kelas,id'
            ],
        ]);

        $mahasiswa = Mahasiswa::find($request->mahasiswa_id);
        $kelas = Kelas::find($request->kelas_id);

        if ($kelas->isFull()) {
            session()->flash('notify', 'Kelas sudah penuh, tidak bisa memindahkan mahasiswa ke kelas ini!');
            session()->flash('type', 'error');
            return redirect()->route('kaprodi.plotting');
        }

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        session()->flash('notify', 'Mahasiswa berhasil dipetakan ke kelas!');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.plotting');
    }

    public function submitDosen(Request $request, $id = null) {
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->id();
        } else {
            return redirect()->back()->withErrors(['user_id' => 'User not authenticated']);
        }

        $dosenExists = Dosen::where('nip', $request->nip)->orWhere('kode_dosen', $request->kode_dosen)->first();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => [
                'required',
                'numeric',
                'max_digits:20',
                'unique:dosen,nip' . ($id ? ",$id" : ''),
            ],
            'kode_dosen' => [
                'required',
                'numeric',
                'digits_between:1,3',
                'unique:dosen,kode_dosen' . ($id ? ",$id" : ''),
            ],
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        if ($dosenExists && !$id) {
            return redirect()->back()->withErrors([
                'duplicate' => 'Dosen dengan NIP yang sama atau Kode Dosen sudah tersedia.'
            ])->withInput();
        }

        if ($id) {
            $dosen = Dosen::find($id);
            $dosen->update($validatedData);
        } else {
            Dosen::create($validatedData);
        }

        session()->flash('notify', $id ? 'Dosen updated successfully' : 'Dosen added successfully!');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.management-dosen');
    }

    public function storeKelas(Request $request, $id = null) {
        if (auth()->check()) {
            $validatedData['user_id'] = auth()->id();
        } else {
            return redirect()->back()->withErrors(['user_id' => 'User not authenticated']);
        }

        $kelasNameExists = Kelas::where('name', $request->name)->first();

        $validateData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:20',
                'unique:kelas,name' . ($id ? ", $id" : ''),
            ],
            'jumlah' => 'required|numeric|max_digits:3',
        ]);

        if($kelasNameExists) {
            return redirect()->back()->withErrors([
                'duplicate' => 'Kelas dengan nama yang sama sudah tersedia.'
            ])->withInput();
        }

        if($id) {
            $kelas = Kelas::find($id);
            $kelas->update($validateData);
        } else {
            Kelas::create($validateData);
        }

        session()->flash('notify', $id ? 'Kelas updated successfully' : 'Kelas added successfully');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.management-kelas');
    }

    public function deleteDataDosen($id) {
        Dosen::findOrFail($id)->delete();
        session()->flash('notify', 'Dosen deleted successfully!');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.management-dosen');
    }

    public function deleteDataKelas($id) {
        if(Mahasiswa::where('kelas_id', $id)->exists()) {
            session()->flash('notify', 'Tidak dapat menghapus, kelas ini terelasi dengan data mahasiswa');
            session()->flash('type', 'error');

            return redirect()->route('kaprodi.management-kelas');
        }
        Kelas::findOrFail($id)->delete();
        session()->flash('notify', 'Kelas deleted successfully!');
        session()->flash('type', 'success');

        return redirect()->route('kaprodi.management-kelas');
    }
}
