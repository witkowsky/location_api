Vue.use(VueResource);

function prepareFormData(object) {
    var formData = new FormData();
    for (var key in object ) {
        if (object[key] !== null) {
            formData.append(key, object[key]);
        }
    }
    return formData;
}

function handleSuccessResponse(action) {
    return response => {
        if (response.body.error) {
            alert('Error: ' + response.body.error);
            return;
        }

        action(response);
    }
}

function handleError(response) {
    alert('Error');
    console.log(response);
}

var app = new Vue({
    el: '#app',
    data: {
        locations: [
        ],
        filter: {
            text: '',
            distance: null
        },
        createForm: {
            name: null,
            address: null,
            latitude: null,
            longitude: null,
        }
    },
    methods: {
        filterLocations: function () {
            var uri = '/location?text=' + this.filter.text + '&distance=' + this.filter.distance;
            this.$http.get(uri).then(
                handleSuccessResponse(response => {
                    this.locations = response.body.data;
                }),
                handleError
            );
        },
        removeLocation: function (location) {
            var uri = '/location/' + location.id;
            this.$http.delete(uri).then(
                handleSuccessResponse(response => {
                    alert('Location ' + location.name + " is removed.");
                    this.filterLocations();
                }),
                handleError
            );
        },
        updateLocation: function (location) {
            var uri = '/location/' + location.id;

            this.$http.post(uri, prepareFormData(location)).then(
                handleSuccessResponse(response => {
                    alert('Location ' + location.name + " is updated.");
                    this.filterLocations();
                }),
                handleError
            );
        },
        createLocation: function (location) {
            if (location.name === null
                || location.address === null
                || location.latitude === null
                || location.longitude === null
            ) {
                alert('Invalid data. Missing param.');
                return;
            }

            var uri = '/location';
            this.$http.post(uri, prepareFormData(location)).then(
                handleSuccessResponse(response => {
                    alert('Location ' + location.name + " is created.");
                    this.createForm = {
                        name: null,
                        address: null,
                        latitude: null,
                        longitude: null
                    };
                    this.filterLocations();
                }), handleError);
        }
    }
});
app.filterLocations();