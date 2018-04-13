package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;

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
    private RecyclerView mSongView;
    private SongAdapter mSongAdapter;
    private List<Song> mSongList;
    private static final String URL = "http://project.codethree.net/api/search.php?by=album_card";

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

        //
        mSongList = new ArrayList<>();
        populateList();

        mSongAdapter = new SongAdapter(this, mSongList);
        mSongView.setAdapter(mSongAdapter);
        mSongView.setLayoutManager(new LinearLayoutManager(this));

    }

    private void populateList()
    {
        // TODO: Use JSON/Google Volley to get a list of songs to populate the list with
        // Add songs to the mSongList list

        JSONObject query = new JSONObject();
        try {
            query.put("query", "sam");
        } catch(JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
                (Request.Method.POST, URL, query, new Response.Listener<JSONObject>() {

                    @Override
                    public void onResponse(JSONObject response) {
                        // TODO: Something here
                        try {
                            JSONArray album = response.getJSONArray("albums");
                            for(int i = 0; i < album.length(); i++)
                            {
                                JSONObject currentObj = album.getJSONObject(i);
                                String albumName = currentObj.getString("name");
                                String year = currentObj.getString("year");
                                String iconURL = currentObj.getString("iconUrl");

                                JSONObject artistObj = currentObj.getJSONObject("artist");
                                String artist = artistObj.getString("name");

                                JSONObject genreObj = currentObj.getJSONObject("genre");
                                String genre = genreObj.getString("name");

                                Song currentSong = new Song(artist, " ", iconURL, "0.0", genre, albumName);
                                mSongList.add(currentSong);
                            }
                        }catch(JSONException e){
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {

                    @Override
                    public void onErrorResponse(VolleyError error) {
                        // TODO: Handle error
                        System.out.println(error);
                    }
                });
        Volley.newRequestQueue(this).add(jsonObjectRequest);
    }
}
