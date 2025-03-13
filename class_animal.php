<?php
class animal {
    public $animal;

    public function __construct($ar_animal)
    {
        $this->animals = $ar_animal;
    }

    public function index(){
        foreach ($this->animals as $animal){
            echo "- $animal<br/>";
        }
    }
    public function store($animal){
        $this->animals[] = $animal;
    }
    public function update($index, $animal)
    {
        $this->animals[$index] = $animal;
    }
    public function destroy($index){
        unset($this->animals[$index]);
    }
}

$animal = new animal (["Ayam", "Ikan"]);

echo  "index - menampilkan seluruh hewan <br/>";
$animal->index();
echo"<br/>";

echo  "store - menampilkan seluruh hewan (Burung)<br/>";
$animal->store("Burung");
$animal->index();
echo"<br/>";

# Method Update
echo  "Update - mengupdate nama hewan <br/>";
$animal->update(0, "Kucing Anggora");
$animal->index();
echo"<br/>";

# Method Destroy
echo  "Destroy - Menghapus nama hewan <br/>";
$animal->destroy(1);
$animal->index();
echo"<br/>";