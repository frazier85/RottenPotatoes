package com.group4.rottenpotatoes;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Adapter;
import android.widget.Button;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class SearchPage extends AppCompatActivity {

    Button mHomeButton;
    Button mSearchButton;
    Button mLoginRegisterButton;

    private static final String URL = "http://project.codethree.net//api/search.php?by=";
    List<Song> mSongList;
    RecyclerView mRecyclerView;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.search_activity);

        // Navigation buttons setup
        mHomeButton = findViewById(R.id.homeButton);
        mSearchButton = findViewById(R.id.searchButton);
        mLoginRegisterButton = findViewById(R.id.loginRegisterButton);

        mLoginRegisterButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), LoginPage.class);
                startActivity(i);
            }
        });

        mHomeButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), MainActivity.class);
                startActivity(i);
            }
        });

        // Recycler View Setup
        mRecyclerView = findViewById(R.id.recyclerView);
        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(this));

        mSongList = new ArrayList<>();

        loadSongs();

//        // Get the intent, verify the action and get the query
//        Intent intent = getIntent();
//        if (Intent.ACTION_SEARCH.equals(intent.getAction())) {
//            String query = intent.getStringExtra(SearchManager.QUERY);
//            search(query);
//        }
    }

    private void loadSongs()
    {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, URL,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting the string to json array object
                            JSONArray array = new JSONArray(response);

                            //traversing through all the object
                            for (int i = 0; i < array.length(); i++)
                            {

                                //getting product object from json array
                                JSONObject song = array.getJSONObject(i);

                                //adding the product to product list
                                mSongList.add(new Song(
                                        song.getString("artist"),
                                        song.getString("title"),
                                        song.getString("link"),
                                        song.getString("review"),
                                        song.getString("genre"),
                                        song.getString("album")
                                ));
                            }

                            //creating adapter object and setting it to recyclerview
                            SongAdapter adapter = new SongAdapter(SearchPage.this, mSongList);
                            mRecyclerView.setAdapter(adapter);

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        //TODO: handle errors
                    }
                });
        Volley.newRequestQueue(this).add(stringRequest);
    }

    private void search(String query)
    {
        // TODO: Perform the search
        // Return search results with an Adapter?
        // https://developer.android.com/guide/topics/search/search-dialog.html


    }
}
