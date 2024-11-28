<?php

namespace App\Livewire\Pages\Profile;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\WithFileUploads;

class Index extends Component
{
  use WithFileUploads;
  #[Layout('layouts.app')]
  #[Title('Profil')]

  public User $user;

  #[Validate('required', message: 'Input field nim tidak boleh kosong')]
  #[Validate('min:3', message: 'Input field nim tidak boleh kurang dari 3 karakter')]
  #[Validate('max:50', message: 'Input field nim tidak boleh lebih dari 50 karakter')]
  #[Validate('regex:/^[a-zA-Z0-9]+$/', message: 'Input field nim hanya boleh mengandung huruf dan angka')]
  public $nim;

  #[Validate('required', message: 'Input field alamat tidak boleh kosong')]
  #[Validate('min:10', message: 'Input field alamat tidak boleh kurang dari 10 karakter')]
  #[Validate('max:100', message: 'Input field alamat tidak boleh lebih dari 100 karakter')]
  #[Validate('regex:/^[a-zA-Z0-9\s,.-]+$/', message: 'Input field alamat hanya boleh mengandung huruf, angka, dan spasi')]
  public $alamat;

  // Validasi untuk field temp profile_picture
  #[Validate('image', message: 'Input field foto profil harus berupa gambar dengan format jpg, jpeg, atau png')]
  #[Validate('mimes:jpg,jpeg,png', message: 'Format file harus berupa jpg, jpeg, atau png')]
  #[Validate('max:500', message: 'Ukuran file maksimal 500kb')]
  public $tempProfilePicture;

  public $openPhotoEditor;
  public $openProfileEditor;

  public function mount()
  {
    $this->user = Auth::user();
    $this->nim = $this->user->nim;
    $this->alamat = $this->user->alamat;
  }

  public function togglePhotoEditor()
  {
    $this->openPhotoEditor = !$this->openPhotoEditor;
  }

  public function toggleProfileEditor()
  {
    $this->openProfileEditor = !$this->openProfileEditor;
  }

  public function updatePhoto()
  {
    try {
      $this->authorize('update', $this->user);
      DB::beginTransaction();
      $this->validate([
        'tempProfilePicture' => 'image|mimes:jpg,jpeg,png|max:500',
      ]);
      if ($this->tempProfilePicture) {
        if ($this->user->profile_picture) {
          Storage::disk('public')->delete($this->user->profile_picture);
        }
        $fileName = 'PP' . '-' . $this->user->name . '-' . now()->format('Y-m-d-H-i-s') . '.' . $this->tempProfilePicture->getClientOriginalExtension();
        $profilePicturePath = $this->tempProfilePicture->storeAs('profile-pictures', $fileName, 'public');
        $this->user->update([
          'profile_picture' => $profilePicturePath
        ]);
      }

      DB::commit();

      return redirect(route('profile.index'))->success('Foto profil berhasil diperbarui');
    } catch (AuthorizationException $e) {
      Toaster::error('Anda tidak memiliki izin untuk mengedit profil ini');
    } catch (Exception $e) {
      DB::rollBack();
      Toaster::error('Terjadi kesalahan saat memperbarui foto profil');
    }
  }

  public function updateProfile()
  {
    try {
      $this->authorize('update', $this->user);
      DB::beginTransaction();
      $this->validate([
        'nim' => ['required',  'min:3', 'max:50', 'regex:/^[a-zA-Z0-9]+$/'],
        'alamat' => ['required', 'min:10', 'max:100', 'regex:/^[a-zA-Z0-9\s,.-]+$/'],
      ]);
      $this->user->update([
        'nim' => $this->nim,
        'alamat' => $this->alamat
      ]);
      DB::commit();
      return redirect(route('profile.index'))->success('Profil berhasil diperbarui');
    } catch (AuthorizationException $e) {
      Toaster::error('Anda tidak memiliki izin untuk mengedit profil ini');
    } catch (Exception $e) {
      DB::rollBack();
      Toaster::error('Terjadi kesalahan saat memperbarui profil');
    }
  }

  public function render()
  {
    return view('livewire.pages.profile.index');
  }
}
