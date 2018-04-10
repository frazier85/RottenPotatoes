package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;

public class SongPage extends AppCompatActivity
{
    private Button mHomeButton;
    private Button mSearchButton;
    private Button mLoginRegisterButton;
    private RecyclerView mCommentView;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.song_page);

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

        // Configure RecyclerView
        mCommentView = findViewById(R.id.recyclerViewComments);

        populateComments();
    }

    private void populateComments()
    {
        // TODO: get comments and ratings from DB
    }
}
