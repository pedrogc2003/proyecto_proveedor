<?php

class Proveedor{
    private string $codigo;
    private string $pwd;
    private string $correo;
    private string $nombre;
    private $misProductos = array();

    // Getter para $codigo
    public function getCodigo(): string {
        return $this->codigo;
    }

    // Setter para $codigo
    public function setCodigo(string $codigo): void {
        $this->codigo = $codigo;
    }

    // Getter para $pwd
    public function getPwd(): string {
        return $this->pwd;
    }

    // Setter para $pwd
    public function setPwd(string $pwd): void {
        $this->pwd = $pwd;
    }

    // Getter para $correo
    public function getCorreo(): string {
        return $this->correo;
    }

    // Setter para $correo
    public function setCorreo(string $correo): void {
        $this->correo = $correo;
    }

    // Getter para $nombre
    public function getNombre(): string {
        return $this->nombre;
    }

    // Setter para $nombre
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    // Getter para $misProductos
    public function getMisProductos(): array {
        return $this->misProductos;
    }

    // Setter para $misProductos
    public function setMisProductos(array $misProductos): void {
        $this->misProductos = $misProductos;
    }
}

?>
