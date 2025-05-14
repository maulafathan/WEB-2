<?php


function getSafeFormValue($variables, $key)
{
  return isset($variables[$key]) ? $variables[$key] : "";
}

function formatHarga($angka) {
  return "Rp " . number_format($angka, 0, ',', '.');
}