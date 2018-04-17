package com.group4.rottenpotatoes;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Message;
import android.support.annotation.NonNull;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.app.LoaderManager.LoaderCallbacks;

import android.content.CursorLoader;
import android.content.Loader;
import android.database.Cursor;
import android.net.Uri;
import android.os.AsyncTask;

import android.app.Activity;
import android.app.ProgressDialog;
import android.util.Log;
import android.os.Build;
import android.os.Bundle;
import android.provider.ContactsContract;
import android.text.TextUtils;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.inputmethod.EditorInfo;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
;
import com.android.volley.Request;
import com.android.volley.Request.Method;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.security.*;

import java.util.HashMap;
import java.util.Map;
import java.util.ArrayList;
import java.util.List;

import static android.Manifest.permission.READ_CONTACTS;
import static java.lang.Boolean.FALSE;
import static java.lang.Boolean.TRUE;

/**
 * A login screen that offers login via username/password.
 */
public class LoginPage extends Activity {
    private static final String TAG = RegisterPage.class.getSimpleName();
    private Button btnLogin;
    private Button btnLinkToRegisterScreen;
    private EditText inputUsername;
    private EditText inputPassword;
    private ProgressDialog pDialog;
    private SessionManager session;
    private SQLiteHandler db;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login);

        inputUsername = findViewById(R.id.username);
        inputPassword = findViewById(R.id.password);
        btnLogin = findViewById(R.id.btnLogin);
        btnLinkToRegisterScreen = (Button) findViewById(R.id.btnLinkToRegisterScreen);

        // Progress dialog
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        // SQLite database handler
        //db = new SQLiteHandler(getApplicationContext());

        // Session manager
        session = new SessionManager(getApplicationContext());

        // Check if user is already logged in or not
        if (session.isLoggedIn()) {
            // User is already logged in. Take him to main activity
            Intent intent = new Intent(LoginPage.this, MainActivity.class);
            startActivity(intent);
            finish();
            Toast.makeText(getApplicationContext(), "Already logged in", Toast.LENGTH_LONG).show();
        }

        // Login button Click Event
        btnLogin.setOnClickListener(new View.OnClickListener() {

            public void onClick(View view) {
                String username = inputUsername.getText().toString().trim();
                String password = inputPassword.getText().toString().trim();

                //Hash the password
                String hashedPass = MD5(password);

                // Check for empty data in the form
                if (!username.isEmpty() && !hashedPass.isEmpty()) {
                    // login user
                    checkLogin(username, hashedPass);
                } else {
                    // Prompt user to enter credentials)
                    Toast.makeText(getApplicationContext(),
                            "Please enter the credentials!", Toast.LENGTH_LONG)
                            .show();
                }
            }

        });

        // Link to Register Screen
        btnLinkToRegisterScreen.setOnClickListener(new View.OnClickListener() {

            public void onClick(View view) {
                Intent i = new Intent(getApplicationContext(),
                        RegisterPage.class);
                startActivity(i);
                finish();
            }
        });

    }

    /**
     * function to verify login details in mysql db

     * */
    private void checkLogin(final String username, final String password) {

        RequestQueue queue = Volley.newRequestQueue(this);
        // Tag used to cancel the request

        pDialog.setMessage("Logging in ...");
        showDialog();

        //Create the object to send to attempt login
        JSONObject logInAttempt = new JSONObject();
        try{
            logInAttempt.put("username", username);
            logInAttempt.put("password", password);
        } catch(JSONException e){
            e.printStackTrace();
        }

        final JsonObjectRequest jobjReq = new JsonObjectRequest(Request.Method.POST, AppConfig.URL_LOGIN,
                logInAttempt, new Response.Listener<JSONObject>() {

            @Override
            public void onResponse(JSONObject response) {
                //Check the json response to see if we logged in properly
                int success;
                Boolean canLogin;

                Log.d(TAG, "Login Response: " + response.toString());
                hideDialog();

                try{
                    success = response.getInt("id");
                    if(success == -1){
                        canLogin = false;
                    }
                    else{
                        canLogin = true;
                    }

                    if(canLogin){
                        session.setLogin(true);
                        Toast.makeText(getApplicationContext(), "Successfully logged in",
                                Toast.LENGTH_LONG).show();

                        //We logged in, go to the main page now
                        Intent intent = new Intent(LoginPage.this, MainActivity.class);
                        startActivity(intent);
                        finish();
                    }
                    else{
                        //We did not successfully login
                        String errorMsg = response.getString("error");
                        Toast.makeText(getApplicationContext(), errorMsg, Toast.LENGTH_LONG).show();
                    }


                } catch(JSONException e){
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Json error:" + e.getMessage(),
                            Toast.LENGTH_LONG).show();
                }


            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Login Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(), error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }

            });
        queue.add(jobjReq);

        }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

    public String MD5(String md5) {
        try {
            java.security.MessageDigest md = java.security.MessageDigest.getInstance("MD5");
            byte[] array = md.digest(md5.getBytes());
            StringBuffer sb = new StringBuffer();
            for (int i = 0; i < array.length; ++i) {
                sb.append(Integer.toHexString((array[i] & 0xFF) | 0x100).substring(1,3));
            }
            return sb.toString();
        } catch (java.security.NoSuchAlgorithmException e) {
        }
        return null;
    }
}
