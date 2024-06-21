package wService;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author janic
 */

//-----------------------------------------------------------------------------------------------------
public class Conexion {

    public static Connection getConexion() {
        Connection conn = null;

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/bdWebService?serverTimezone=UTC&useSSL=false", "root", "");

        } catch (ClassNotFoundException e) {
            System.out.println("[Error] Driver MySQL JDBC no encontrado: " + e.getMessage());

        } catch (SQLException e) {
            System.out.println("[Error] Error de conexion: " + e.getMessage());
        }
        return conn;
    }

    public static void main(String[] args) {
        // Obtener la conexión a través del método estático de la clase Conexion
        Connection conn = Conexion.getConexion();

        // Comprobar si la conexión es exitosa
        if (conn != null) {
            System.out.println("Conexión exitosa!");

            // Cerrar la conexión después de la prueba
            try {
                conn.close();
            } catch (SQLException e) {
                System.out.println("[Error] No se pudo cerrar la conexión: " + e.getMessage());
            }
        } else {
            System.out.println("Conexión fallida.");
        }
    }

}
