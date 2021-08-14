/*
 * Autor: Erick Lopez Lara
 * Matircula: ES162000869
 * */
package com.erichlz.miscabarapp;
/**
 * Clase que realiza el registro de las relaciones de registro del producto con el usuario que las realiza
 * */
public class RelacionRegistros {
/**
 * Propiedades de Clase
 * */
    public String fk_username;
    public String fk_codigo;
/**
 * Método contructor
 * @param fk_username Recibe el nombre del usuario
 * @param fk_codigo Recibe el codigo del producto.
 * */
    public RelacionRegistros(String fk_username, String fk_codigo) {
        this.fk_username = fk_username;
        this.fk_codigo = fk_codigo;
    }


}
