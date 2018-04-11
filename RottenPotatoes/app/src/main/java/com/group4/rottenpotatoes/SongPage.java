package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class SongPage extends AppCompatActivity
{
    private Button mHomeButton;
    private Button mSearchButton;
    private Button mLoginRegisterButton;

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

        populateComments();
    }

    private void populateComments()
    {
        // TODO: get comments and ratings from DB
        String titleText = "The title would go here";
        String artistText = "The artist would go here";
        String albumText = "Album would go here";
        String reviewText = "5.0";

        TextView title = findViewById(R.id.textViewTitleSongPage);
        title.setText(titleText);

        TextView artist = findViewById(R.id.textViewArtistSongPage);
        artist.setText(artistText);

        TextView album = findViewById(R.id.textViewArtistSongPage);
        album.setText(albumText);

        TextView review = findViewById(R.id.textViewReviewSongPage);
        review.setText(reviewText);

    }
}
