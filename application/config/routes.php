<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'GuestController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//just guest
$route['kegiatan'] = 'GuestController/kegiatan';

//
$route['login']='AuthController/login';
$route['register']='AuthController/register';
$route['ver']='AuthController/ver';
$route['logout']='AuthController/logout';
// $route['t/(:any)']='TestController/$1';

//need role user to get in

//User
//(:num) atau number:untuk menentukan segment yg bersangkutan beruapa number
//(:any) atau semua : untuk menentukan segment yang bersangkutan berupa semua karakter (angka, huruf, spesial karakter yg diizinkan dlm URL)
$route['detail/(:num)']='UserController/detailTiket/$1';
$route['pemesanan']='UserController/pemesanan';
$route['pemesanan/(:any)']='UserController/pemesanan/$1';
$route['tiket']='UserController/infotiket';


//Admin
$route['admin']='AdminController/index';

//kegiatan
$route['admin/kegiatan']='AdminController/kegiatan';
$route['admin/kegiatan/hapus/(:num)']='AdminController/deleteKegiatan/$1';
$route['admin/kegiatan/edit/(:num)']='AdminController/editKegiatan/$1';
$route['admin/kegiatan/tambah']='AdminController/tambahKegiatan';

//Tiket
$route['admin/tiket']='AdminController/tiket';
$route['admin/tiket/hapus/(:num)']='AdminController/dellTiket/$1';
$route['admin/tiket/edit/(:num)']='AdminController/editTiket/$1';
$route['admin/tiket/tambah']='AdminController/addTiket';
$route['admin/tiket/update_stok']='AdminController/updateStok';

//Pengguna
$route['admin/pengguna']='AdminController/pengguna';
$route['admin/pengguna/hapus/(:num)']='AdminController/deletePengguna/$1';

// laporan
$route['admin/lapkeuangan'] = 'AdminController/lapkeuangan';

//pemesanan
$route['admin/pemesanan']='AdminController/pemesanan';

//cetak
$route['admin/cetaklaporan/(:any)']='AdminController/cetaklaporan/$1';