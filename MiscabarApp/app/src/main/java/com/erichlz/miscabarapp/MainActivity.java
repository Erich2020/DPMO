/*
 * Autor: Erick Lopez Lara
 * Matircula: ES162000869
 * */
package com.erichlz.miscabarapp;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.Collection;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import static java.lang.Thread.sleep;
/**
 * Clase Principal. Contiene el loggin de la aplicacion
 * */
public class MainActivity extends AppCompatActivity {
    /*
    * Atributos de la clase
    * */
    private EditText user;
    private EditText pwd;
    private boolean seAutentico = false;
    private ProgressDialog proceso;
    //URL del servicio Web, se deja en variable con path absoluta, para optimizar el desarrollo. No es buena practica.
    private String url ="https://protomiscabar.000webhostapp.com/S_Validar_Sesion.php";
    /*
    * Metodo contrusctivo para la ejecucion de la activity
    * Se general al sincroniazcion de los componentes gráficos con componenetes entendibles a Java
    * */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        user = (EditText)findViewById(R.id.eTxVwUsername);
        pwd=(EditText)findViewById(R.id.eTxVwPwd);
    }
/**
 *
 * Método btnIniciarSesion. Este desencadena las acciones y se vincula con el buttinView de la interfaz gráfica.
 * Realiza la validacion de los contenidos de los EditTextView.
 * Ejecuta el Método Autenticar
 * */
    public void btnIniciarSesion(View view){

        if(esValidoString(this.user.getText().toString()) && esValidoString(this.pwd.getText().toString()))
        {
            Autenticar(this.url,this,user.getText().toString(),pwd.getText().toString());
        }else {
            Toast.makeText(this,"Es Necesario Ingresar Usuario/Contraseña.", Toast.LENGTH_LONG).show();
    }
    }

/**
 * Método que realiza la validacion del texto contenido de un String mediante regular Expressions
 * Valida que contenga caracteres entre 1 a 30 y que estos sean de la A-Z en mayusculas y minusculas y valores Numericos 0 al 9
 * */
    private boolean esValidoString(String target){
        return Pattern.matches("[a-zA-Z0-9]{1,30}", target);
        }
/**
 * Método que realiza la finalizacion la activity. Vinculado al Evento Listener del textView Salir
 * */
    public void btnSalir(View view){
        this.finish();
   }
/**
*  Metodo vinculado al event listener del TextView Registrarse. Ejecuta el cambio de Activity
* */
   public void btnRegistrarse(View view){
        Intent i = new Intent(this, FRegistroUsuario.class);
        startActivity(i);
   }

   /**
    * Método que realiza la validacion de las credenciales de acceso en el Loggin.
    * @param url Recibe la URL que contiene el servicio web en metodo Post.
    * @param context Recibe el context actual para presentar las respuestas del servidor
    * @param username Recibe el nombre de usuario para su validacion
    * @param pwd recibe la contraseña del usuario para su validacion
    * */
    public void Autenticar(String url, Context context, String username, String pwd){
        // Se genera un ProgressDialog para indicar al usuario Espera respuesta de Autenticacion
        ProgressDialog p = new ProgressDialog(MainActivity.this);
        p.setProgressStyle(ProgressDialog.STYLE_SPINNER);
        p.setCancelable(false);
        p.isIndeterminate();
        p.show();
        // Permite almacenar y mantener en espera las peticiones HTTP/s agregandolas a una cola por medio de Volley en el contexto indicado
        RequestQueue requestQueue = Volley.newRequestQueue(context);
        // Realiza el tratamiento de las solicitudes y respuestas ofrecidas por el webservice recibe de paramentros la URL, Tipo de Metodo, lista de ResponseListener positivas, y Response.Listener de Error
        StringRequest stringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            //Sobre carga del Metodo OnResponse, Escuchando a la espera del procesamiento de la respuesta
            @Override
            public void onResponse(String response) {
                // Se realiza una validacion interna del objeto enviado por el WebServer. Se agrego para optimizar el desarrollo. Requiere detalla en Conjunto con el WebService y sus estados
                if(response.equals("true"))
                {
                    //Si la respuesta es favorable se canaliza al Activity Producto.
                    Intent i = new Intent(context, Producto.class);
                    // Se envia el valor del usuario al Siguiente Activity
                    i.putExtra("username",user.getText().toString());
                    startActivity(i);
                }
            }
        }, new Response.ErrorListener() {
            // Sobrecarga de Metodo que esta a la escucha y  espera de un error de solicitud y recibiendo su respuesta de error
            @Override
            public void onErrorResponse(VolleyError error) {
                // Se notifica al usuario error de contraseña, el Web server tiene solo una respuesta erronea en caso de no coincidir la autenticacion.
                Toast.makeText(context,"El Usuario/Contraseña No son Validos.", Toast.LENGTH_LONG).show();
            }
        }){
            //sobre carga de Metodo permite estructurar los datos, para se entendibles por el WebService. (JSON serializer).
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> parametros = new HashMap<String, String>();
                // los datos e agregan en orden de valor asociativo y valor a registrar
                // El valor Asociativo es igual al que presenta la estructura de datos del webService en su apartado clave.
                parametros.put("username", username);
                parametros.put("pwd", pwd);
                //Devuelve los parametros agregados para ser procesados en la estructura.
                return parametros;
            }
        };
        //Se agrega la solicitud StrinRequest en el Queue o cola de procesos de espera
        requestQueue.add(stringRequest);
        // se finaliza el ProgresDisplay
        p.dismiss();
    }


}