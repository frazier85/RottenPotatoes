package com.group4.rottenpotatoes;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class RegisterPage extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_page);

        Intent intent = getIntent();
        String message = intent.getStringExtra(LoginPage.EXTRA_MESSAGE);

    }
}
