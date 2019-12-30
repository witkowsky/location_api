<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 *
 * @package App\Controller
 */
class IndexController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function action(ServerRequestInterface $request): ResponseInterface
    {
        $html = <<<HTML
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="app">
                    <h3>Filters</h3>
                    <label for="filter-text">Name/Address</label>
                    <input id="filter-text" v-model="filter.text">
                    <label for="filter-distance">Distance</label>
                    <input id="filter-distance" v-model="filter.distance" type="number">
                    <td>
                        <button v-on:click="filterLocations">Filter</button>
                    </td>
                    <h3>Locations</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>name</td>
                                <td>address</td>
                                <td>latitude</td>
                                <td>longitude</td>
                                <td>distance to home.pl</td>
                                <td>delete</td>
                                <td>update</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="location in locations">
                                <td>{{location.id}}</td>
                                <td>
                                    <input v-model="location.name">
                                </td>
                                <td>
                                    <input v-model="location.address">
                                </td>
                                <td>
                                    <input v-model="location.latitude">
                                </td>
                                <td>
                                    <input v-model="location.longitude">
                                </td>
                                <td>
                                    {{ location.distance }}
                                </td>
                                <td>
                                    <button v-on:click="removeLocation(location)">Remove</td>
                                <td>
                                    <button v-on:click="updateLocation(location)">Update</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Create new</h3>
                    <form v-on:submit.prevent>
                        <label for="create-form-name">Name</label>
                        <input id="create-form-name" v-model="createForm.name">
                        <label for="create-form-address">Address</label>
                        <input id="create-form-address" v-model="createForm.address">
                        <label for="create-form-latitude">Latitude</label>
                        <input id="create-form-latitude" v-model="createForm.latitude">
                        <label for="create-form-longitude">Longitude</label>
                        <input id="create-form-longitude" v-model="createForm.longitude">
                        <input type="submit" v-on:click="createLocation(createForm)">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="app.js"></script>
</body>

</html>
HTML;
        return $this->createHtmlResponse($html);
    }
}