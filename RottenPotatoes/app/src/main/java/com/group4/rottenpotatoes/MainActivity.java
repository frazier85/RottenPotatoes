package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    private Button mHomeButton;
    private Button mSearchButton;
    private Button mLoginRegisterButton;
    private RecyclerView mSongView;
    private SongAdapter mSongAdapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.main_activity);

        // Configure bottom bar buttons
        mHomeButton = findViewById(R.id.homeButton);
        mSearchButton = findViewById(R.id.searchButton);
        mLoginRegisterButton = findViewById(R.id.loginRegisterButton);

        mLoginRegisterButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(v.getContext(), LoginPage.class);
                startActivity(i);
            }
        });

        mSearchButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(v.getContext(), SearchPage.class);
                startActivity(i);
            }
        });

        mHomeButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(v.getContext(), MainActivity.class);
                startActivity(i);
            }
        });

        mSongView = findViewById(R.id.recyclerViewMain);
        ArrayList<Song> allSongs = new ArrayList<>();
        mSongAdapter = new SongAdapter(this, allSongs);
        mSongView.setAdapter(mSongAdapter);
        populateList();
    }

    private void populateList()
    {
        // TODO: Use JSON/Google Volley to get a list of movies to populate the list with
    }
}
