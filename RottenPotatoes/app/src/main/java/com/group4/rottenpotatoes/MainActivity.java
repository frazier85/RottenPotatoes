package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

import static com.android.volley.Request.Method.POST;

public class MainActivity extends AppCompatActivity {

    private Button mHomeButton;
    private Button mSearchButton;
    private Button mLoginRegisterButton;
    private Button btnLogout;
    private RecyclerView mSongView;
    private SongAdapter mSongAdapter;
    private List<Song> mSongList;
    private ImageView mIconView;
    private static final String URL = "http://project.codethree.net/api/general.php?action=mostrecent";

    private SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.main_activity);

        // Configure bottom bar buttons
        mHomeButton = findViewById(R.id.homeButton);
        mSearchButton = findViewById(R.id.searchButton);
        mLoginRegisterButton = findViewById(R.id.loginRegisterButton);
        btnLogout = (Button) findViewById(R.id.btnLogout);

        session = new SessionManager(getApplicationContext());

        btnLogout.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                logoutUser();
            }
        });

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
        mSongView.setHasFixedSize(true);
        mSongView.setLayoutManager(new LinearLayoutManager(this));

        mSongList = new ArrayList<>();
        populateList();

    }

    private void populateList()
    {
        JSONObject query = new JSONObject();

        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
                (Request.Method.POST, URL, null, new Response.Listener<JSONObject>() {

                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray album = response.getJSONArray("albums");
                            for(int i = 0; i < album.length(); i++)
                            {
                                JSONObject currentObj = album.getJSONObject(i);
                                String albumName = currentObj.getString("name");
                                String year = currentObj.getString("year");
                                String iconURL = currentObj.getString("iconUrl");

                                String rating = currentObj.getString("rating");
                                int ratingInt = Integer.parseInt(rating);
                                if(ratingInt == -1)
                                    rating = "Not yet reviewed!";
                                else if(ratingInt < 0)
                                    rating = "0";
                                else if (ratingInt > 5)
                                    rating = "5.0";

                                JSONObject artistObj = currentObj.getJSONObject("artist");
                                String artist = artistObj.getString("name");

                                JSONObject genreObj = currentObj.getJSONObject("genre");
                                String genre = genreObj.getString("name");

                                Song currentSong = new Song(artist, year, iconURL, rating, genre, albumName);
                                mSongList.add(currentSong);
                            }
                            SongAdapter adapter = new SongAdapter(MainActivity.this, mSongList);
                            mSongView.setAdapter(adapter);
                        } catch(JSONException e){
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {

                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // Not going to worry about error handling on the main page
                        // /since it's just a static query
                    }
                });
        Volley.newRequestQueue(this).add(jsonObjectRequest);
    }

    //Log out the user by setting session flag to false
    private void logoutUser(){
        session.setLogin(false);

        Intent intent = new Intent(MainActivity.this, LoginPage.class);
        startActivity(intent);
        finish();
        Toast.makeText(getApplicationContext(), "User logged out", Toast.LENGTH_LONG).show();
    }
}
