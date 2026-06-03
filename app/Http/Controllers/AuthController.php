<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $username = $request->input('username');
    $password = $request->input('password');

    // Mencari user berdasarkan username di database db_inventori_barang
    $user = DB::table('users')->where('username', $username)->first();

    if ($user) {
      if (password_verify($password, $user->password)) {
        return response()->json([
          'status'  => 'success',
          'message' => 'Login berhasil!',
          'role'    => $user->role,
          'user'    => [
            'id_user'      => $user->id_user,
            'nama_lengkap' => $user->nama_lengkap,
            'username'     => $user->username,
            'role'         => $user->role
          ]
        ], 200);
      } else {
        return response()->json([
          'status'  => 'error',
          'message' => 'Password yang Anda masukkan salah!'
        ], 401);
      }
    } else {
      return response()->json([
        'status'  => 'error',
        'message' => 'Username tidak terdaftar di sistem!'
      ], 404);
    }
  }
}
