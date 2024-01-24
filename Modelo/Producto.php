<?php

class Producto {
    private string $codigo;
    private string $descripcion;
    private float $precio;
    private int $stock;
    private Proveedor $miProveedor;

    public function __construct(String $codigo, String $descripcion, float $precio, int $stock, Proveedor $miProveedor){
        $this->codigo = $codigo;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->miProveedor = $miProveedor;   
    }

    // Getter para $codigo
    public function getCodigo(): string {
        return $this->codigo;
    }

    // Setter para $codigo
    public function setCodigo(string $codigo): void {
        $this->codigo = $codigo;
    }

    // Getter para $descripcion
    public function getDescripcion(): string {
        return $this->descripcion;
    }

    // Setter para $descripcion
    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    // Getter para $precio
    public function getPrecio(): float {
        return $this->precio;
    }

    // Setter para $precio
    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }

    // Getter para $stock
    public function getStock(): int {
        return $this->stock;
    }

    // Setter para $stock
    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    // Getter para $miProveedor
    public function getMiProveedor(): Proveedor {
        return $this->miProveedor;
    }

    // Setter para $miProveedor
    public function setMiProveedor(Proveedor $miProveedor): void {
        $this->miProveedor = $miProveedor;
    }
}

?>
