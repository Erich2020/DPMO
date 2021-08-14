/*
* Autor: Erick Lopez Lara
* Matircula: ES162000869
* */

package com.erichlz.miscabarapp;

import android.content.Context;
import android.widget.Toast;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import java.util.HashMap;
import java.util.Map;
/**
 * Clase Usuario. Representacion de la estructura para el registro o consulta en el inicio de sesion
 *
 * */
public class Usuario {
/**
 * Propiedades de la Clase
 */

    String nombre;
    String usuario;
    String pwd;
/**
 * Método Constructor.
 * @param nombre Recibe el nombre del usuario.
 * @param usuario Recibe el username
 * @param pwd Recibe la contraseña del usuario
 * */
    public Usuario(String nombre, String usuario, String pwd) {
        this.nombre = nombre;
        this.usuario = usuario;
        this.pwd = pwd;
    }

    /**
     * Método que realiza el registro de un usuario por medio del webService
     * @param URL Recibe la url que contiene la direccion del webservice
     * @param context Recibe el contexto de la activity
     * */

    public void Registrar(String URL, Context context){
        // Permite almacenar y mantener en espera las peticiones HTTP/s agregandolas a una cola por medio de Volley en el contexto indicado

        RequestQueue requestQueue= Volley.newRequestQueue(context);
        // Realiza el tratamiento de las solicitudes y respuestas ofrecidas por el webservice recibe de paramentros la URL, Tipo de Metodo, lista de ResponseListener positivas, y Response.Listener de Error

        StringRequest stringRequest=new StringRequest
                (Request.Method.POST, URL, new Response.Listener<String>() {
                    //Sobre carga del Metodo OnResponse, Escuchando a la espera del procesamiento de la respuesta

                    @Override
                    public void onResponse(String response) {
                        Toast.makeText (context, response, Toast.LENGTH_SHORT).show();
                    }
                }, new Response.ErrorListener(){
                    // Sobrecarga de Metodo que esta a la escucha y  espera de un error de solicitud y recibiendo su respuesta de error

                    @Override
                    public void onErrorResponse(VolleyError error)
                    {
                        Toast.makeText(context,error.getMessage().toString(),Toast.LENGTH_SHORT).show ();
                    }
                }){
            //sobre carga de Metodo permite estructurar los datos, para se entendibles por el WebService. (JSON serializer).

            @Override
            protected Map<String,String> getParams()throws AuthFailureError {
                Map<String,String> parametros = new HashMap<String, String>();
                // los datos e agregan en orden de valor asociativo y valor a registrar
                // El valor Asociativo es igual al que presenta la estructura de datos del webService en su apartado clave.
                parametros.put("username",usuario);
                parametros.put("nombre",nombre);
                parametros.put("pwd", pwd);
                //Devuelve los parametros agregados para ser procesados en la estructura.
                return parametros;
            }
            //sobre carga de Metodo que valida solicitude del web server para los headers.
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> parametros = new HashMap<String, String>();
                parametros.put("Content-Type","application/x-www-form-urlencoded");
                return parametros;
            }
        };
        //Se agrega la solicitud StrinRequest en el Queue o cola de procesos de espera
        requestQueue.add(stringRequest);
    }

}

