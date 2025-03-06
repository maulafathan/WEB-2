<?php
$proses = $_POST['proses'];
$nama_siswa = $_POST['nama'];
$mata_kuliah = $_POST['matkul'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_uas = $_POST['nilai_uas'];
$nilai_tugas = $_POST['nilai_tugas'];

// Menghitung Nilai Akhir
$nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);

// Menentukan Lulus atau Tidak
$status = ($nilai_akhir >= 55) ? 'Lulus' : 'Tidak Lulus';

// Menentukan Grade Nilai
if ($nilai_akhir < 0 || $nilai_akhir > 100) {
    $grade = 'I'; // Grade I untuk nilai tidak valid
} elseif ($nilai_akhir >= 85) {
    $grade = 'A';
} elseif ($nilai_akhir >= 70) {
    $grade = 'B';
} elseif ($nilai_akhir >= 56) {
    $grade = 'C';
} elseif ($nilai_akhir >= 36) {
    $grade = 'D';
} else {
    $grade = 'E';
}

// Menentukan Predikat Nilai
switch ($grade) {
    case 'A':
        $predikat = 'Sangat Memuaskan';
        break;
    case 'B':
        $predikat = 'Memuaskan';
        break;
    case 'C':
        $predikat = 'Cukup';
        break;
    case 'D':
        $predikat = 'Kurang';
        break;
    case 'E':
        $predikat = 'Sangat Kurang';
        break;
    case 'I':
        $predikat = 'Tidak Ada';
        break;
    default:
        $predikat = 'Tidak Diketahui';
        break;
}

// MENCETAK HASIL
if (!empty($proses)) {
    echo 'Proses : ' . $proses;
    echo '<br/>Nama : ' . $nama_siswa;
    echo '<br/>Mata Kuliah : ' . $mata_kuliah;
    echo '<br/>Nilai UTS : ' . $nilai_uts;
    echo '<br/>Nilai UAS : ' . $nilai_uas;
    echo '<br/>Nilai Tugas Praktikum : ' . $nilai_tugas;
    echo '<br/>Nilai Akhir : ' . number_format($nilai_akhir, 2);
    echo '<br/>Status : ' . $status;
    echo '<br/>Grade : ' . $grade;
    echo '<br/>Predikat : ' . $predikat;
}
?>