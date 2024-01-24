<?php

class Proveedor {
    private string $codigo;
    private string $pwd;
    private string $correo;
    private string $nombre;
    private array $misProductos = array();

    public function __construct(string $codigo, string $pwd, string $correo, string $nombre) {
        $this->codigo = $codigo;
        $this->pwd = $pwd;
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->misProductos = array();
    }

    public function getCodigo(): string {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): void {
        $this->codigo = $codigo;
    }

    public function getPwd(): string {
        return $this->pwd;
    }

    public function setPwd(string $pwd): void {
        $this->pwd = $pwd;
    }

    public function getCorreo(): string {
        return $this->correo;
    }

    public function setCorreo(string $correo): void {
        $this->correo = $correo;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    // Getter y Setter para $misProductos
    public function getMisProductos(): array {
        return $this->misProductos;
    }

    public function setMisProductos(array $misProductos): void {
        $this->misProductos = $misProductos;
    }
}

?>
