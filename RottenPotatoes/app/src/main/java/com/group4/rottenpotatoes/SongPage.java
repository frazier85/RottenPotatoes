package com.group4.rottenpotatoes;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import java.io.InputStream;

public class SongPage extends AppCompatActivity
{
    private Button mHomeButton;
    private Button mSearchButton;
    private Button mLoginRegisterButton;
    private ImageView mImageView;

    private String mYearText;
    private String mArtistText;
    private String mAlbumText;
    private String mReviewText;
    private String mUrl;


    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.song_page);
        Bundle b = getIntent().getExtras();
        mAlbumText = b.getString("album");
        mYearText = b.getString("year");
        mArtistText = b.getString("artist");
        mReviewText = b.getString("review");
        mUrl = b.getString("url");

        mImageView = findViewById(R.id.imageViewSongPage);

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


        TextView title = findViewById(R.id.textViewTitleSongPage);
        title.setText(mYearText);

        TextView artist = findViewById(R.id.textViewArtistSongPage);
        artist.setText(mArtistText);

        TextView album = findViewById(R.id.textViewAlbumSongPage);
        album.setText(mAlbumText);

        TextView review = findViewById(R.id.textViewReviewSongPage);
        review.setText(mReviewText);
        // Get the album art, if available
        if(!mUrl.isEmpty())
        {
            new SongPage.DownloadImageTask(mImageView).execute(mUrl);
        }
        else
        {
            new SongPage.DownloadImageTask(mImageView).execute("https://s3.amazonaws.com/detroitpubliclibrary/assets/images/material-cd.jpg");
        }

    }

    private static class DownloadImageTask extends AsyncTask<String, Void, Bitmap>
    {
        ImageView bmImage;

        public DownloadImageTask(ImageView bmImage) {
            this.bmImage = bmImage;
        }

        protected Bitmap doInBackground(String... urls) {
            String urldisplay = urls[0];
            Bitmap mIcon11 = null;
            try {
                InputStream in = new java.net.URL(urldisplay).openStream();
                mIcon11 = BitmapFactory.decodeStream(in);
            } catch (Exception e) {
                Log.e("Error", e.getMessage());
                e.printStackTrace();
            }
            return mIcon11;
        }

        protected void onPostExecute(Bitmap result) {
            bmImage.setImageBitmap(result);
        }
    }

}
