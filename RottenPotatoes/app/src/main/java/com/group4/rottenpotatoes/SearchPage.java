package com.group4.rottenpotatoes;

import android.app.SearchManager;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.widget.SearchView;
import android.view.View;
import android.widget.Button;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
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
    SearchView mSearchView;

    private static final String URL = "http://project.codethree.net/api/search.php?by=album_card";
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

        // SearchView setup
        SearchManager searchManager = (SearchManager) getSystemService(Context.SEARCH_SERVICE);
        mSearchView = findViewById(R.id.searchView);
        mSearchView.setSearchableInfo(searchManager.getSearchableInfo(getComponentName()));
        mSearchView.setIconifiedByDefault(false);

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

        mSongList = new ArrayList<>();

        // Recycler View Setup
        mRecyclerView = findViewById(R.id.recyclerViewSearch);
        mRecyclerView.setHasFixedSize(true);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(this));
        mRecyclerView.setAdapter(new SongAdapter(this, mSongList));

        // Get the intent, verify the action and get the query
        Intent intent = getIntent();
        if (Intent.ACTION_SEARCH.equals(intent.getAction())) {
            String query = intent.getStringExtra(SearchManager.QUERY);
            search(query);
        }
    }



    private void search(String query)
    {
        mSongList = new ArrayList<Song>();
        JSONObject searchQuery = new JSONObject();
        try {
            searchQuery.put("query", query);
        } catch(JSONException e) {
            e.printStackTrace();
        }

        JsonObjectRequest jsonObjectRequest = new JsonObjectRequest
                (Request.Method.POST, URL, searchQuery, new Response.Listener<JSONObject>() {

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

                                JSONObject artistObj = currentObj.getJSONObject("artist");
                                String artist = artistObj.getString("name");

                                JSONObject genreObj = currentObj.getJSONObject("genre");
                                String genre = genreObj.getString("name");

                                Song currentSong = new Song(artist, " ", iconURL, "0.0", genre, albumName);
                                mSongList.add(currentSong);
                            }
                            SongAdapter adapter = new SongAdapter(SearchPage.this, mSongList);
                            mRecyclerView.swapAdapter(adapter, true);
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
