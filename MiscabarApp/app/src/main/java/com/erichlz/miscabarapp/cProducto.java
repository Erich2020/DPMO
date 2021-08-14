/*
 * Autor: Erick Lopez Lara
 * Matircula: ES162000869
 * */
package com.erichlz.miscabarapp;

import android.content.Context;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.text.DecimalFormat;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
/**
 * Clase cProducto Permite manejar los datos que se recibiran por parte del web service.
 * contiene la estructura de datos adaptada a la respuesta POST del web service.
 * */
public class cProducto {
    /**
     * Atributos de a clase
     *
     * */

    private String codigo;
    private String descripcion;
    int presentacion;
    private String costo;
    private String precio;
    private String marca;
    // Se instancia la clase Relacion Registros.
    RelacionRegistros rr;
    /**
     * Método Constructor de la clase
     * @param codigo Recibe el codigo del producto
     * @param descripcion Recibe la descripcion del producto
     * @param presentacion Recibe la clave de la presentacion del producto
     * @param costo Recibe el costo del producto.
     * @param precio Recibe el precio del producto
     * @param marca Recibe la marca del producto
     * @param username Recibe el username que realiza el proceso de registro
     * */
    public cProducto(String codigo, String descripcion, int presentacion, String costo, String precio, String marca, String username) {
        //Asignacion de valores en las propiedades del objeto
        this.codigo = codigo;
        this.descripcion = descripcion;
        this.presentacion = presentacion;
        this.costo = costo;
        this.precio = precio;
        this.marca = marca;
        rr= new RelacionRegistros(username, codigo);
    }

    /**
     * Método que permite realizar la solicitud para el registro de los datos contenidos en el objeto hacie el WebService.
     * @param URL Recibe la URL que contiene el Servicio a solicitar.
     * @param context Recibe el contexto de la activity donde se invoca para proporcionalr los mensajes de respuesta de WebService.
     * */
    public void Registrar(String URL, Context context){
        // Permite almacenar y mantener en espera las peticiones HTTP/s agregandolas a una cola por medio de Volley en el contexto indicado
        RequestQueue requestQueue = Volley.newRequestQueue(context);
        // Realiza el tratamiento de las solicitudes y respuestas ofrecidas por el webservice recibe de paramentros la URL, Tipo de Metodo, lista de ResponseListener positivas, y Response.Listener de Error
        StringRequest stringRequest=new StringRequest
                (Request.Method.POST, URL, new Response.Listener<String>() {
                    //Sobre carga del Metodo OnResponse, Escuchando a la espera del procesamiento de la respuesta

                    @Override
                    public void onResponse(String response) {
                        Toast.makeText (context,response, Toast.LENGTH_SHORT).show();
                    }
                }, new Response.ErrorListener(){
                    // Sobrecarga de Metodo que esta a la escucha y  espera de un error de solicitud y recibiendo su respuesta de error
                    @Override
                    public void onErrorResponse(VolleyError error)
                    {
                        Toast.makeText(context,error.getMessage().toString(),Toast.LENGTH_SHORT).show();
                    }
                }){
            //sobre carga de Metodo permite estructurar los datos, para se entendibles por el WebService. (JSON serializer).

            @Override
            protected Map<String,String> getParams()throws AuthFailureError {
                Map<String,String> parametros=new HashMap<String, String>();
                // los datos e agregan en orden de valor asociativo y valor a registrar
                // El valor Asociativo es igual al que presenta la estructura de datos del webService en su apartado clave.
                parametros.put ("codigo",codigo);
                parametros.put ("descripcion",descripcion);
                parametros.put ("presentacion", presentacion+"");
                parametros.put("costo",costo);
                parametros.put("precio",precio);
                parametros.put("marca",marca);
                parametros.put("username",rr.fk_username);
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
