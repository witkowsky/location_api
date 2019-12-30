Vue.use(VueResource);

function prepareFormData(object) {
    var formData = new FormData();
    for (var key in object ) {
        formData.append(key, object[key]);
    }
    return formData;
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
            this.$http.get(uri).then(response => {
                this.locations = response.body.data;
            });
        },
        removeLocation: function (location) {
            var uri = '/location/' + location.id;
            this.$http.delete(uri).then(response => {
                alert('Location ' + location.name + " is removed.");
                this.filterLocations();
            });
        },
        updateLocation: function (location) {
            var uri = '/location/' + location.id;

            this.$http.post(uri, prepareFormData(location)).then(response => {
                alert('Location ' + location.name + " is updated.");
                this.filterLocations();
            });
        },
        createLocation: function (location) {
            var uri = '/location';
            this.$http.post(uri, prepareFormData(location)).then(response => {
                alert('Location ' + location.name + " is created.");
                this.createForm = {
                    name: null,
                    address: null,
                    latitude: null,
                    longitude: null
                };
                this.filterLocations();
            });
        }
    }
});
app.filterLocations();