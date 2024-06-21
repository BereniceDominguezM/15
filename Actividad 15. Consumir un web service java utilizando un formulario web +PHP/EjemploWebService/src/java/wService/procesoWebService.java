/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package wService;

import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

import java.io.*;
import java.sql.*;
import javax.swing.JOptionPane;

/**
 *
 * @author janic
 */
@WebService(serviceName = "procesoWebService")
public class procesoWebService {

    // VARIABLES CORRESPONDIENTES A LOS CAMPOS DE LA TABLA
    private int idUsuario;
    private String nombre;
    private String apellidos;
    private String correo;

    Connection conn = null;

    
    //------------------------------------------------ SAVE
    @WebMethod
    public void save(String nom, String ape, String cor) {
        System.out.println("Estamos dentro del metodo Save");
        String query = "INSERT INTO usuarios VALUES(null, ?, ?, ?)";

        try (Connection conn = Conexion.getConexion();
                PreparedStatement pt = conn.prepareStatement(query)) {

            pt.setString(1, nom);
            pt.setString(2, ape);
            pt.setString(3, cor);

            int filasInsertadas = pt.executeUpdate();

            if (filasInsertadas > 0) {
                System.out.println("Registro guardado exitosamente.");
                conn.commit(); // Realizar commit después de la inserción
            } else {
                System.out.println("No se pudo insertar el registro en la base de datos.");
            }

        } catch (SQLException sqle) {
            System.out.println("Save: Hubo un error en la base de datos " + sqle.getMessage());
            sqle.printStackTrace(); // Imprime el stack trace para obtener más detalles del error
        }
    }

    //------------------------------------------------ UPDATE
    @WebMethod
    public void update(int id, String nom, String ape, String cor) {
        System.out.println("Estamos dentro del metodo Update");
        String queryUpdate = "UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ? WHERE idUsuario = ?";

        try {
            conn = Conexion.getConexion();
            PreparedStatement pt = null;
            pt = conn.prepareStatement(queryUpdate);

            pt.setString(1, nom);
            pt.setString(2, ape);
            pt.setString(3, cor);
            pt.setInt(4, id);
            pt.executeUpdate();
            pt.close();
            conn.close();

        } catch (SQLException sqle) {
            System.out.println("Update: Hubo un eror en la base de datos " + sqle);
        }
    }

    //------------------------------------------------ DELETE
    @WebMethod
    public void delete(int id) {
        System.out.println("Estamos dentro del metodo Delete");
        String query = "DELETE FROM usuarios WHERE idUsuario = ?";
        try {
            conn = Conexion.getConexion();
            PreparedStatement pt = null;
            pt = conn.prepareStatement(query);
            pt.setInt(1, id);
            pt.execute();
            pt.close();
            conn.close();

        } catch (SQLException sqle) {
            System.out.println("Delete: Hubo un error en la base de datos " + sqle);
        }
    }

    //------------------------------------------------ SEARCHUSER
    
    @WebMethod
    public void searchUser(int id) {
        System.out.println("Estamos dentro del metodo SearchUser");
        String query = "SELECT * FROM usuarios WHERE idUsuario = ?";
        try (
                Connection conn = Conexion.getConexion();
                PreparedStatement pt = conn.prepareStatement(query)) {
            pt.setInt(1, id);
            try (ResultSet rs = pt.executeQuery()) {
                if (rs.next()) {
                    idUsuario = rs.getInt("idUsuario");
                    nombre = rs.getString("nombre");
                    apellidos = rs.getString("apellidos");
                    correo = rs.getString("correo");

                    mostrarId();
                    mostrarNombre();
                    mostrarApellidos();
                    mostrarCorreo();
                } else {
                    System.out.println("No user found with id: " + id);
                }
            }
        } catch (SQLException sqle) {
            System.out.println("[searchUser]: Hubo un error en la base de datos " + sqle.getMessage());
        }
    }

    //************************************************ MOSTRARID
    @WebMethod
    public int mostrarId() {
        int id;
        id = 0;
        id = idUsuario;
        return id;
    }

    //************************************************ MOSTRARNOMBRE
    @WebMethod
    public String mostrarNombre() {
        String nom;
        nom = "";
        nom = nombre;
        return nom;
    }

    //************************************************ MOSTRARAPELLIDOS
    @WebMethod
    public String mostrarApellidos() {
        String ape;
        ape = "";
        ape = apellidos;
        return ape;
    }

    //************************************************ MOSTRARCORREO
    @WebMethod
    public String mostrarCorreo() {
        String cor;
        cor = "";
        cor = correo;
        return cor;
    }

    /**
     * This is a sample web service operation
     */
    @WebMethod(operationName = "hello")
    public String hello(@WebParam(name = "name") String txt) {
        return "Hello " + txt + " !";
    }
}
