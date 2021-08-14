/*
 * Autor: Erick Lopez Lara
 * Matircula: ES162000869
 * */
package com.erichlz.miscabarapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import java.util.regex.Pattern;
/**
 *
 * Clase que presenta la activity y el formulario para el registro de usuarios
 *
 * */
public class FRegistroUsuario extends AppCompatActivity {
    /**
     * Atributos de a clase
     *
     * */
    EditText nombre;
    EditText usuario;
    EditText pwd;
    EditText confirmaPwd;
    // URL Absoluta que contiene el servicio solicitado del WebService. Falta refinar configuraciones para una URL Relativa y tener una base.
    private String url = "https://protomiscabar.000webhostapp.com/S_Registro_Usuario.php";
    /*
     * Metodo contrusctivo para la ejecucion de la activity
     * Se general al sincroniazcion de los componentes gráficos con componenetes entendibles a Java
     * */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_f_registro_usuario);
        nombre = (EditText)findViewById(R.id.eTxNombre);
        usuario = (EditText)findViewById(R.id.eTxUser);
        pwd = (EditText)findViewById(R.id.eTxPwd);
        confirmaPwd = (EditText)findViewById(R.id.eTxConfirmPwd);
    }
/**
 * Método vinculado con el Evento listener de un Botton. Realiza el registro de un usuario y regresa al activity principal.
 * @param view Recibe una vista
 * */
    public void btnRegistrar(View view){
    if(validarCampos() & validarPwd())
    {
        getUsuario().Registrar(url,this);
        limpiarCampos();
        Intent i = new Intent(this,MainActivity.class);
        startActivity(i);
    }

    }
    /**
    * Método vinculado con el Evento listener de un Botton. Realiza la limpieza de los campos y regresa al Activity principal
     *
    * */
    public void btnCancelar(View vew){
        limpiarCampos();
        Intent i = new Intent(this, MainActivity.class);
        startActivity(i);
    }
/**
 * Metodo que obtiene un objeto del tipo Usuario.
 *
 * */
    public Usuario getUsuario(){
    return new Usuario(this.nombre.getText().toString(),
            this.usuario.getText().toString(),
            this.pwd.getText().toString());
    }
    /**
     * Metodo que realiza la validacion de los campos de EditTextView.
     *
     * */
    private boolean validarCampos(){
        if(esValidoPwd(this.pwd.getText().toString().trim()) &
                esValidoNombre(this.nombre.getText().toString()) &
                esValidoUser(this.usuario.getText().toString().trim()))
             return true;
        else
            return false;
    }

    /**
     * Método que realiza la validacion de la Constraseña y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean esValidoPwd(String target) {
        if(Pattern.matches("[a-zA-Z0-9]{6,20}", target))
            return true;
        else {
            Toast.makeText(this, "Favor de Validar la Constraseña debe contener entre 6 a 20 carateres (a-z, A-Z, 0-9)", Toast.LENGTH_SHORT).show();
            return false;
        }
    }
    /**
     * Método que realiza la validacion del Nombre y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean esValidoNombre(String target) {
        if(Pattern.matches("[a-zA-Z0-9]{4,100}",target))
            return true;
        else {
            Toast.makeText(this, "Favor de Validar el Nombre debe contener entre 4 a 100 carateres sin espacios (a-z, A-Z, 0-9)", Toast.LENGTH_SHORT).show();
            return false;
        }

    }
    /**
     * Método que realiza la validacion del Usuario y cumpla con los requerimientos, mediante  Regular Expressions
     * @param target recibe una cadena de texto para su tratamiento.
     * */
    private boolean esValidoUser(String target) {
        if(Pattern.matches("[a-zA-Z0-9]{4,20}",target))
        return true;
        else {
            Toast.makeText(this, "Favor de Validar la Usuario debe contener entre 4 a 20 carateres (a-z, A-Z, 0-9)", Toast.LENGTH_SHORT).show();
            return false;
        }
    }
/**
 * Método que realiza la asígna un valor vacio a los editTextView
 *
 * */
    private void limpiarCampos(){
        this.nombre.setText("");
        this.usuario.setText("");
        this.pwd.setText("");
        this.confirmaPwd.setText("");
    }
    /**
     * Valida que la contraseña se confirme.
     * */
    private boolean validarPwd(){
        if(pwd.getText().toString().equals(confirmaPwd.getText().toString()))
            return true;
        else {
            Toast.makeText(this,"La contraseña no coincide. Favor de Verificar.",Toast.LENGTH_LONG).show();
            return false;
        }
    }
}