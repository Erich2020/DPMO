/*
 * Autor: Erick Lopez Lara
 * Matircula: ES162000869
 * */
package com.erichlz.miscabarapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;

import java.util.regex.Pattern;
/**
 * Clase Producto. Contiene el formulario que permite registrar productos a la base de datos.
 *
 * */
public class Producto extends AppCompatActivity {
    /**
     * Propiedades de la coase
     * */
    EditText eTxcodigo;
    EditText eTxDescripcion;
    EditText eTxcosto;
    EditText eTxPrecio;
    EditText eTxMarca;
    RadioButton rBtnPiezas;
    RadioButton rBtnGranel;
    RadioButton rBtnOtro;
    String username;
    // URL Absoluta que contiene el servicio solicitado del WebService. Falta refinar configuraciones para una URL Relativa y tener una base.

    private String url ="https://protomiscabar.000webhostapp.com/S_Registro_Producto.php";
    /*
     * Metodo contrusctivo para la ejecucion de la activity
     * Se general al sincroniazcion de los componentes gráficos con componenetes entendibles a Java
     * */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_producto);
        sincronizarComponentes();
        this.username = getIntent().getStringExtra("username");
        Toast.makeText(this,"Bienvenido "+username,Toast.LENGTH_LONG).show();
    }
/**
 * Sincroniza el conjunto de los View con los componentes entendibles a java
 *
 * */
    private void sincronizarComponentes(){
        eTxcodigo = (EditText)findViewById(R.id.eTxCodigo);
        eTxDescripcion = (EditText)findViewById(R.id.eTxDescripcion);
        eTxcosto =(EditText)findViewById(R.id.eTxCosto);
        eTxPrecio = (EditText)findViewById(R.id.eTxPrecio);
        eTxMarca = (EditText)findViewById(R.id.eTxMarca);
        rBtnPiezas = (RadioButton)findViewById(R.id.rBtnPiezas);
        rBtnGranel = (RadioButton)findViewById(R.id.rBtnGranel);
        rBtnOtro = (RadioButton)findViewById(R.id.rBtnOtro);
    }
    /**
     * Método vinculado con el Evento listener de un Botton. Realiza el registro de un producto y regresa al activity principal.
     * @param view Recibe una vista
     * */
    public void btnCrearProducto(View view){
        if(validarCampos()){
            getProducto().Registrar(url,this);
            limpiarCampos();
        }
    }
    /**
     * Metodo que obtiene un objeto del tipo Usuario.
     *
     * */
    private cProducto getProducto(){
        return new cProducto(this.eTxcodigo.getText().toString(),
                this.eTxDescripcion.getText().toString(),
                getPresentacion(),
                this.eTxcosto.getText().toString(),
                this.eTxPrecio.getText().toString(),
                this.eTxMarca.getText().toString(),
                this.username
                );
    }

    /**
     * Metodo que realiza la validacion de los campos de EditTextView.
     *
     * */
    private boolean validarCampos(){

        if(validarcodigo(this.eTxcodigo.getText().toString().trim()) &
                validarDescripcion(this.eTxDescripcion.getText().toString()) &
                validarCosto(this.eTxcosto.getText().toString()) &
                validarPrecio(this.eTxPrecio.getText().toString()) &
                validarMarca(this.eTxMarca.getText().toString())
                ){
            return true;
        }else {
            return false;
        }
    }
    /**
     * Método que realiza la validacion de la Código de Producto y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean validarcodigo(String target) {
        if(Pattern.matches("[a-zA-Z0-9]{1,30}",target))
        return true;
        else {
            Toast.makeText(this, "Es necesario llenar el campo 'Código de Producto'", Toast.LENGTH_LONG).show();
            return false;
        }
    }
    /**
     * Método que realiza la validacion de la Descripcion del Producto y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean validarDescripcion(String target) {
        if(Pattern.matches("[a-zA-Z0-9]{1,3000}", target))
        return true;
        else {
            Toast.makeText(this, "Es necesario llenar el campo 'Descripcion del Producto'", Toast.LENGTH_LONG).show();
            return false;
        }
    }
    /**
     * Método que realiza la validacion de la Costo del Producto y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean validarCosto(String target) {
        if(Pattern.matches("[0-9]{1}",target))
        return true;
        else {
            Toast.makeText(this, "Es necesario llenar el campo 'Costo del Producto'", Toast.LENGTH_LONG).show();
            return false;
        }
    }

    /**
     * Método que realiza la validacion de la Precio Unitario y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */

    private boolean validarPrecio(String target) {
        if(Pattern.matches("[0-9]{1}",target))
            return true;
        else {
            Toast.makeText(this, "Es necesario llenar el campo 'Precio Unitario'", Toast.LENGTH_LONG).show();
            return false;
        }
    }

    /**
     * Método que realiza la validacion de la Marca y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */

    private boolean validarMarca(String target) {
        if (Pattern.matches("[a-zA-Z0-9]{1,40}",target))
            return true;
        else {
            Toast.makeText(this, "Es necesario llenar el campo 'Marca'", Toast.LENGTH_LONG).show();
            return false;
        }
    }

    /**
     * Se realiza la validacion del grupo de radiobutton para obtener el seccionado y asígnar su valor numerico
     * */
    private int getPresentacion(){
        int presentacion = 0;

        if(this.rBtnGranel.isChecked()){
            presentacion = 2;
        }else if(this.rBtnPiezas.isChecked()){
            presentacion = 1;
        }else if(this.rBtnOtro.isChecked()){
            presentacion = 3;
        }else Toast.makeText(this,"Seleccione un Atributo de Presentación",Toast.LENGTH_LONG).show();

        return  presentacion;
    }
    /**
     * Método vinculado con el Evento listener de un Botton. Realiza la limpieza de los campos
     *
     * */
    public void btnCancelar(View view){
        limpiarCampos();
    }
    /**
     * Método que realiza la asígna un valor vacio a los editTextView
     *
     * */
    public void limpiarCampos(){
        eTxcodigo.setText("");
        eTxDescripcion.setText("");
        eTxcosto.setText("");
        eTxPrecio.setText("");
        eTxMarca.setText("");
        rBtnPiezas.setChecked(true);
        rBtnGranel.setChecked(false);
        rBtnOtro.setChecked(false);
    }
}