<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Request as ModelsRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MahasiswaController extends Controller {
    public function index(): View {
        $mahasiswa = Mahasiswa::all();

        return view('mahasiswa.dashboard', [
            'breadcrumb' => 'Dashboard',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function requestEditView(): View {
        $mahasiswa = Mahasiswa::with('kelas')->where('user_id', auth()->id())->get();

        return view('mahasiswa.request-edit', [
            'breadcrumb' => 'Permintaan Edit',
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function storeEditRequest(Request $request) {
        $validatedData = $request->validate([
            'keterangan' => 'required|string|max:255',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',   
            'kelas_id' => 'required|exists:kelas,id',   
        ]);

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->first();

        if ($mahasiswa && !$mahasiswa->edit) {
            ModelsRequest::create([
                'mahasiswa_id' => $mahasiswa->id,
                'keterangan' => $validatedData['keterangan'],
                'kelas_id' => $request->kelas_id,
            ]);

            $mahasiswa->save();

            session()->flash('notify', 'Permintaan edit berhasil dikirim!');
            session()->flash('type', 'success');
        } else {
            session()->flash('notify', 'Anda sudah memiliki permintaan edit yang sedang diproses.');
            session()->flash('type', 'error');
        }

        return redirect()->route('mahasiswa.request-edit');
    }

    public function updateMahasiswaByRequest(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:mahasiswa,nim,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ]);

        $mahasiswa = Mahasiswa::find($id);

        if($mahasiswa->user_id !== auth()->id()) {
            return abort(403, 'Unauthorized action, tidak dapat mengubah data Mahasiswa lain');
        }

        $mahasiswa->update($validatedData);

        $mahasiswa->edit = false;
        $mahasiswa->save();

        session()->flash('notify', 'Data Mahasiswa berhasil diperbarui!');
        session()->flash('type', 'success');

        return redirect()->route('mahasiswa.dashboard');
    }

    public function show($id): View {
        $mahasiswa = Mahasiswa::with('kelas')->findOrFail($id);

        return view('mahasiswa.show-detail', [
            'breadcrumb' => 'Detail Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ]);
    }

}
