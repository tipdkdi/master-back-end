<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $fatik = "Fakultas Tarbiyah dan Ilmu Keguruan";
        $febi = "Fakultas Ekonomi dan Bisnis Islam";
        $fasya = "Fakultas Syariah";
        $fuad = "Fakultas Ushuluddin Adab dan Dakwah";
        $pascasarjana = "Pascasarjana";

        DB::table('biodatas')->insert([
            [
                'nik' => '1234567890123456',
                'nama_lengkap' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'lahir_tempat' => 'Jakarta',
                'lahir_tanggal' => '1990-01-01',
                'no_hp' => '081234567890',
                'agama' => 'islam',
                'alamat_domisili' => 'Jl. Merdeka No. 123, Jakarta',
            ],
            [
                'nik' => '734567890123456',
                'nama_lengkap' => 'Wahyu',
                'jenis_kelamin' => 'L',
                'lahir_tempat' => 'Jakarta',
                'lahir_tanggal' => '1990-01-01',
                'no_hp' => '081234567890',
                'agama' => 'islam',
                'alamat_domisili' => 'Jl. Merdeka No. 123, Jakarta',
            ],
        ]);

        DB::table('tahun_akademiks')->insert([
            [
                'tahun' => '2024',
                'semester' => 'Ganjil',
                'sebutan' => '2024/2025 Ganjil',
                'kode' => '20241',
            ],
            [
                'tahun' => '2024',
                'semester' => 'Genap',
                'sebutan' => '2024/2025 Genap',
                'kode' => '20242',
            ],
            [
                'tahun' => '2025',
                'semester' => 'Ganjil',
                'sebutan' => '2025/2026 Ganjil',
                'kode' => '20251',
            ],
            [
                'tahun' => '2025',
                'semester' => 'Genap',
                'sebutan' => '2025/2026 Genap',
                'kode' => '20252',
            ],
        ]);
        DB::table('users')->insert([
            [
                'name' => 'super_admin',
                'email' => 'super_admin@iainkendari.ac.id',
                'password' => bcrypt('1234qwer'),
            ],
            [
                'name' => 'Eko Wahyu',
                'email' => 'ewp@iainkendari.ac.id',
                'password' => bcrypt('1234qwer'),
            ]
        ]);
        DB::table('user_biodatas')->insert([
            [
                'user_id' => 1,
                'biodata_id' => 1,
            ],
            [
                'user_id' => 2,
                'biodata_id' => 2,
            ]
        ]);
        DB::table('roles')->insert([
            [
                'role_nama' => 'Administrator Utama',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Administrator SPMB',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Mahasiswa',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Pegawai',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Panitia SPMB',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Verifikator UKT',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Admin PNBP',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Admin Akademik',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Admin Prodi',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Dosen',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Kaprodi',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Dekan',
                'keterangan' => '',
            ],
            [
                'role_nama' => 'Admin PDDIKTI',
                'keterangan' => '',
            ],
        ]);

        DB::table('user_roles')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
                'is_default' => 1,
                'is_active' => 1,
            ],
            [
                'user_id' => 2,
                'role_id' => 1,
                'is_default' => 1,
                'is_active' => 1,
            ],
            [
                'user_id' => 2,
                'role_id' => 2,
                'is_default' => 0,
                'is_active' => 1,
            ],
        ]);
        DB::table('organisasi_grups')->insert([
            [
                "grup_nama" => "Institusi",
                "grup_singkatan" => "Institusi",
                'pimpinan_sebutan' => "Rektor",
                'grup_flag' => "rektor",
                'grup_keterangan' => "Grup Institusi"
            ],
            [
                "grup_nama" => "Fakultas",
                "grup_singkatan" => "Fakultas",
                'pimpinan_sebutan' => "dekan",
                'grup_flag' => "fakultas",
                'grup_keterangan' => "Grup Fakultas"
            ],
            [
                "grup_nama" => "Program Studi",
                "grup_singkatan" => "Prodi",
                'pimpinan_sebutan' => "Kepal Program Studi",
                'grup_flag' => "prodi",
                'grup_keterangan' => "Grup Prodi"
            ],
            [
                "grup_nama" => "Pascasarjana",
                "grup_singkatan" => "Pascasarjana",
                'pimpinan_sebutan' => "Direktur",
                'grup_flag' => "pasca",
                'grup_keterangan' => "Grup Pascasarjana"
            ],
            [
                "grup_nama" => "Lembaga",
                "grup_singkatan" => "Lembaga",
                'pimpinan_sebutan' => "ketua",
                'grup_flag' => "lembaga",
                'grup_keterangan' => "Grup Lembaga"
            ],
            [
                "grup_nama" => "Unit Pelaksana Teknis",
                "grup_singkatan" => "UPT",
                'pimpinan_sebutan' => "Kepala",
                'grup_flag' => "upt",
                'grup_keterangan' => "Grup Unit Pelaksana Teknis"
            ],
            [
                "grup_nama" => "Biro Administrasi Umum Akademik Kemahasiswaan",
                "grup_singkatan" => "Biro AUAK",
                'pimpinan_sebutan' => "Kepala Biro",
                'grup_flag' => "karo",
                'grup_keterangan' => "-"
            ],
            [
                "grup_nama" => "Organisasi Kemahasiswaan",
                "grup_singkatan" => "UK Lembaga",
                'pimpinan_sebutan' => "Ketua",
                'grup_flag' => "uklembaga",
                'grup_keterangan' => "-"
            ],
            [
                "grup_nama" => "Wakil Rektor Bidang Akademik dan ",
                "grup_singkatan" => "Wakil Rektor",
                'pimpinan_sebutan' => "Wakil Rektor",
                'grup_flag' => "warek",
                'grup_keterangan' => "-"
            ],

        ]);

        DB::table('organisasis')->insert([
            [
                "organisasi_nama" => "Rektorat",
                "singkatan" => "Rektorat",
                "organisasi_grup_id" => 1,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "-",
                "urutan" => "1",
                "is_current" => true,
                "is_aktif" => true
            ],
            [
                "organisasi_nama" => $fatik,
                "singkatan" => "FATIK",
                "organisasi_grup_id" => 2,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "30",
                "singkatan_sia" => "FATIK",
                "urutan" => "2",
                "is_current" => true,
                "is_aktif" => true
            ],
            [
                "organisasi_nama" => $fasya,
                "singkatan" => "FASYA",
                "organisasi_grup_id" => 2,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "30",
                "singkatan_sia" => "FASYA",
                "urutan" => "3",
                "is_current" => true,
                "is_aktif" => true
            ],
            [
                "organisasi_nama" => $fuad,
                "singkatan" => "FUAD",
                "organisasi_grup_id" => 2,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "30",
                "singkatan_sia" => "FUAD",
                "urutan" => "4",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => $pascasarjana,
                "singkatan" => "PASCASARJANA",
                "organisasi_grup_id" => 4,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "35",
                "singkatan_sia" => "PASCA",
                "urutan" => "5",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => $febi,
                "singkatan" => "FEBI",
                "organisasi_grup_id" => 2,
                'parent_id' => null,
                "keterangan" => "",
                "pddikti_kode" => "30",
                "singkatan_sia" => "FEBI",
                "urutan" => "6",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pendidikan Agama Islam",
                "singkatan" => "PAI",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PAI",
                "urutan" => "7",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pendidikan Bahasa Arab",
                "singkatan" => "PBA",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PBA",
                "urutan" => "8",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Manajemen Pendidikan Islam",
                "singkatan" => "MPI",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "KI",
                "urutan" => "9",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pendidikan Guru Madrasah Ibtidaiyah",
                "singkatan" => "PGMI",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PGMI",
                "urutan" => "10",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pendidikan Islam Anak Usia Dini",
                "singkatan" => "PIAUD",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PGRA",
                "urutan" => "11",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Tadris Bahasa Inggris",
                "singkatan" => "TBI",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "BING",
                "urutan" => "12",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Tadris IPA",
                "singkatan" => "TIPA",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "IPA",
                "urutan" => "13",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Tadris Biologi",
                "singkatan" => "TBLG",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "BLG",
                "urutan" => "14",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Tadris Fisika",
                "singkatan" => "TFSK",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "FSK",
                "urutan" => "15",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Tadris Matematika",
                "singkatan" => "TMTK",
                "organisasi_grup_id" => 3,
                'parent_id' => 2,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "MTK",
                "urutan" => "16",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Hukum Keluarga Islam (Ahwal Syakhshiyyah)",
                "singkatan" => "AS",
                "organisasi_grup_id" => 3,
                'parent_id' => 3,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "AS",
                "urutan" => "17",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Hukum Ekonomi Syariah (Mua'malah)",
                "singkatan" => "MU",
                "organisasi_grup_id" => 3,
                'parent_id' => 3,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "MU",
                "urutan" => "18",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Hukum Tatanegara (Siyasah Syar'iyyah)",
                "singkatan" => "HTN",
                "organisasi_grup_id" => 3,
                'parent_id' => 3,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "HTN",
                "urutan" => "19",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Komunikasi dan Penyiaran Islam",
                "singkatan" => "KPI",
                "organisasi_grup_id" => 3,
                'parent_id' => 4,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "KPI",
                "urutan" => "20",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Bimbingan Penyuluhan Islam",
                "singkatan" => "BPI",
                "organisasi_grup_id" => 3,
                'parent_id' => 4,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "BPI",
                "urutan" => "21",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Manajemen Dakwah",
                "singkatan" => "MD",
                "organisasi_grup_id" => 3,
                'parent_id' => 4,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "MD",
                "urutan" => "22",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Ilmu Al-Qur'an dan Tafsir",
                "singkatan" => "IQT",
                "organisasi_grup_id" => 3,
                'parent_id' => 4,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "IQT",
                "urutan" => "23",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Manajemen Pendidikan Islam",
                "singkatan" => "MPI S2",
                "organisasi_grup_id" => 3,
                "keterangan" => "",
                'parent_id' => 5,
                "pddikti_kode" => "-",
                "singkatan_sia" => "MPI",
                "urutan" => "24",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pendidikan Agama Islam",
                "singkatan" => "PAI S2",
                "organisasi_grup_id" => 3,
                'parent_id' => 5,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PAIS",
                "urutan" => "25",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Hukum Keluarga Islam (Ahwal Syakhshiyyah)",
                "singkatan" => "HKI S2",
                "organisasi_grup_id" => 3,
                'parent_id' => 5,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "HI",
                "urutan" => "26",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Ekonomi Syariah",
                "singkatan" => "ESY S2",
                "organisasi_grup_id" => 3,
                'parent_id' => 5,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "ESY",
                "urutan" => "27",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Ekonomi Syariah",
                "singkatan" => "ESY",
                "organisasi_grup_id" => 3,
                'parent_id' => 6,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "EI",
                "urutan" => "28",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Perbankan Syariah",
                "singkatan" => "PBS",
                "organisasi_grup_id" => 3,
                'parent_id' => 6,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "PBS",
                "urutan" => "29",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Manajemen Bisnis Syariah",
                "singkatan" => "MBS",
                "organisasi_grup_id" => 3,
                'parent_id' => 6,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "MBS",
                "urutan" => "30",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Lembaga Penelitian dan Pengabdian Kepada Masyarakat",
                "singkatan" => "LPPM",
                "organisasi_grup_id" => 5,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "LLPM",
                "urutan" => "31",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Lembaga Penjamin Mutu",
                "singkatan" => "LPM",
                "organisasi_grup_id" => 5,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "LPM",
                "urutan" => "32",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Teknologi Informasi dan Pangkalan Data",
                "singkatan" => "UPT TIPD",
                "organisasi_grup_id" => 6,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "UPT TIPD",
                "urutan" => "33",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Perpustakaan",
                "singkatan" => "UPT Perpustakaaan",
                "organisasi_grup_id" => 6,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "UPT Perpustakaan",
                "urutan" => "34",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Pengembangan Bahasa",
                "singkatan" => "UPT Bahasa",
                "organisasi_grup_id" => 6,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "UPT Bahasa",
                "urutan" => "35",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Ma'had Al Jamiah",
                "singkatan" => "UPT Ma'had",
                "organisasi_grup_id" => 6,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "UPT Ma'had",
                "urutan" => "36",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Satuan Pengawas Internal",
                "singkatan" => "SPI",
                "organisasi_grup_id" => 1,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "SPI",
                "urutan" => "37",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Bagian Perencanaan dan Keuangan",
                "singkatan" => "Keuangan",
                "organisasi_grup_id" => 7,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "Keuangan",
                "urutan" => "38",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Bagian Umum",
                "singkatan" => "Umum",
                "organisasi_grup_id" => 7,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "-",
                "urutan" => "39",
                "is_current" => true,
                "is_aktif" => true

            ],
            [
                "organisasi_nama" => "Bagian Akademik dan Kemahasiswaan",
                "singkatan" => "AKMA",
                "organisasi_grup_id" => 7,
                'parent_id' => 1,
                "keterangan" => "",
                "pddikti_kode" => "-",
                "singkatan_sia" => "-",
                "urutan" => "40",
                "is_current" => true,
                "is_aktif" => true
            ]
        ]);
        DB::table('pegawai_status_asns')->insert([
            ['asn_nama' => 'Pegawai Negeri Sipil', "singkatan" => "PNS", 'is_asn' => true, 'sebutan_nomor_induk' => 'NIP'],
            ['asn_nama' => 'Pegawai Pemerintah dengan Perjanjian Kerja', "singkatan" => "PPPK", 'is_asn' => true, 'sebutan_nomor_induk' => 'NI PPPK'],
            ['asn_nama' => 'Non-ASN', "singkatan" => "Non-ASN", 'is_asn' => false, 'sebutan_nomor_induk' => 'Nomor Pegawai'],
        ]);
        DB::table('master_jabatans')->insert([
            ['jabatan' => 'Pranata Komputer', 'is_dosen' => false, 'keterangan' => 'Prakom'],
        ]);
        DB::table('pegawai_kategoris')->insert([
            [
                'kategori' => 'Tenaga Kependidikan',
                "alias" => "pegawai",
                'keterangan' => '',
            ],
            [
                'kategori' => 'Dosen',
                "alias" => "dosen",
                'keterangan' => '',
            ],
            [
                'kategori' => 'Honorer',
                "alias" => "honorer",
                'keterangan' => '',
            ]
        ]);
        DB::table('master_pekerjaans')->insert([
            [
                "pekerjaan" => "Pegawai Bank",
                "pddikti_id" => "6",
                "emis_id" => "06"
            ],
            [
                "pekerjaan" => "Buruh",
                "pddikti_id" => "11",
                "emis_id" => "15"
            ],
            [
                "pekerjaan" => "Dosen Non PNS",
                "pddikti_id" => "99",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "Guru Non PNS",
                "pddikti_id" => "99",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "Ibu Rumah Tangga",
                "pddikti_id" => "99",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "LAINNYA",
                "pddikti_id" => "99",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "Meninggal",
                "pddikti_id" => "98",
                "emis_id" => "88"
            ],
            [
                "pekerjaan" => "Nelayan",
                "pddikti_id" => "2",
                "emis_id" => "14"
            ],
            [
                "pekerjaan" => "Pegawai Non PNS",
                "pddikti_id" => "99",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "Pegawai Swasta",
                "pddikti_id" => "6",
                "emis_id" => "06"
            ],
            [
                "pekerjaan" => "Pengusaha",
                "pddikti_id" => "10",
                "emis_id" => "07"
            ],
            [
                "pekerjaan" => "Pensiunan PNS",
                "pddikti_id" => "12",
                "emis_id" => "02"
            ],
            [
                "pekerjaan" => "Peternak",
                "pddikti_id" => "4",
                "emis_id" => "13"
            ],
            [
                "pekerjaan" => "PNS Dosen",
                "pddikti_id" => "5",
                "emis_id" => "05"
            ],
            [
                "pekerjaan" => "PNS Guru",
                "pddikti_id" => "5",
                "emis_id" => "05"
            ],
            [
                "pekerjaan" => "PNS Non Dosen",
                "pddikti_id" => "5",
                "emis_id" => "03"
            ],
            [
                "pekerjaan" => "Purnawirawan TNI/ POLRI",
                "pddikti_id" => "12",
                "emis_id" => "02"
            ],
            [
                "pekerjaan" => "Sopir/ Masinis/ Kondektur",
                "pddikti_id" => "0",
                "emis_id" => "16"
            ],
            [
                "pekerjaan" => "Petani",
                "pddikti_id" => "3",
                "emis_id" => "13"
            ],
            [
                "pekerjaan" => "Tidak Bekerja",
                "pddikti_id" => "1",
                "emis_id" => "01"
            ],
            [
                "pekerjaan" => "Tenaga Hukum",
                "pddikti_id" => "0",
                "emis_id" => "08"
            ],
            [
                "pekerjaan" => "Tenaga Kesehatan",
                "pddikti_id" => "0",
                "emis_id" => "10"
            ],
            [
                "pekerjaan" => "TNI/ POLRI",
                "pddikti_id" => "5",
                "emis_id" => "04"
            ],
            [
                "pekerjaan" => "Wakil Bupati",
                "pddikti_id" => "0",
                "emis_id" => "18"
            ],
            [
                "pekerjaan" => "Wiraswasta",
                "pddikti_id" => "9",
                "emis_id" => "07"
            ]
        ]);
        DB::table('master_pendapatans')->insert([
            [
                "pendapatan" => "Rp. 0",
                "pddikti_id" => "0"
            ],
            [
                "pendapatan" => "<= Rp. 500.000",
                "pddikti_id" => "11"
            ],
            [
                "pendapatan" => "Rp. 500.000 s/d Rp. 999.000",
                "pddikti_id" => "12"
            ],
            [
                "pendapatan" => "Rp. 1.000.000 s/d 1.999.000",
                "pddikti_id" => "13"
            ],
            [
                "pendapatan" => "Rp. 2.000.000 s/d 2.999.000",
                "pddikti_id" => "14"
            ],
            [
                "pendapatan" => "Rp. 3.000.000 s/d 3.999.000",
                "pddikti_id" => "14"
            ],
            [
                "pendapatan" => "Rp. 4.000.000 s/d 4.999.000",
                "pddikti_id" => "14"
            ],
            [
                "pendapatan" => ">= Rp. 5.000.000",
                "pddikti_id" => "15"
            ]
        ]);

        DB::table('master_jabatans')->insert([
            [
                'jabatan' => 'Pranata Komputer',
                'is_dosen' => 0,
                'keterangan' => '',
            ],
            [
                'jabatan' => 'Pranata Humas',
                'is_dosen' => 0,
                'keterangan' => '',
            ],
        ]);
    }
}
