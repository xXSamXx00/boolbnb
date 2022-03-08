<template>
  <div class="container font_style">
    <div class="row justify-content-left">
      <!-- Filter Rooms and Kilometers -->
      <div class="col-md-6">
        <div class="row justify-content-center">
          <div
            class="d-flex flex-wrap justify-content-center align-items-center"
          >
            <div
              class="
                col-12 col-sm-8 col-md-8 col-lg-4 col-xl-3
                mx-2
                mb-3
                fields
              "
            >
              <label for="n_rooms" class="form-label"> N° camere Min</label>
              <input
                type="number"
                min="0"
                max="200"
                class="form-control"
                name="n_rooms"
                id="n_rooms"
                aria-describedby="n_roomsHelper"
                placeholder="1"
                v-model="n_rooms"
              />
            </div>
            <div
              class="
                col-12 col-sm-8 col-md-8 col-lg-4 col-xl-3
                mx-2
                mb-3
                fields
              "
            >
              <label for="n_bed" class="form-label">N° letti Min</label>
              <input
                type="number"
                min="0"
                max="5000"
                class="form-control"
                name="n_bed"
                id="n_bed"
                aria-describedby="n_bedHelper"
                placeholder="1"
                v-model="n_bed"
              />
            </div>
            <div
              class="
                col-12 col-sm-8 col-md-8 col-lg-4 col-xl-3
                mx-2
                mb-3
                fields
              "
            >
              <label for="distance" class="form-label"
                >Raggio distanza Km</label
              >
              <input
                type="number"
                min="20"
                max="5000"
                class="form-control"
                name="distance"
                id="distance"
                aria-describedby="distanceHelper"
                placeholder="20"
                v-model="distance"
              />
            </div>
          </div>
          <!--Services filter -->
          <div
            class="
              d-flex
              service_checkbox
              flex-wrap
              justify-content-center
              align-items-center
              py-4
            "
          >
            <div
              class="py-2"
              v-for="service in services"
              v-bind:key="service.id"
            >
              <div class="form-check mx-2">
                <input
                  type="checkbox"
                  class="form-check-input"
                  :name="service.name"
                  :id="service.id"
                  :value="service.id"
                  v-model="v_services"
                />
                <label class="form-check-label service_name" for="">
                  {{ service.name }}
                </label>
              </div>
            </div>
          </div>
          <!-- Button Advanced Search -->
          <div class="col-md-6">
            <div class="d-flex mx-1 justify-content-center align-items-center">
              <button
                class="btn btn_search text-white my-3"
                @click="searchFunction()"
              >
                Ricerca avanzata
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Mappa -->
      <div class="col-md-6">
        <div class="d-flex justify-content-center align-items-center">
          <div id="map" ref="mapRef" class="col-4 col-4-md map"></div>
        </div>
      </div>
    </div>

    <!-- Results Advanced search -->
    <div class="row flex-wrap justify-content-center align-items-center mt-1">
      <div
        class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3"
        v-for="apartment in apartments"
        :key="apartment.id"
      >
        <div class="ads card card_promo m-3">
          <a :href="'/guest/apartments/' + apartment.slug" class="">
            <img
              class="card-img-top thumb"
              :src="'storage/' + apartment.image"
              alt="Card image cap"
            />
          </a>

          <h2 class="card-text m-3 card_title">
            {{ apartment.title }}
          </h2>
          <div class="box">
            <p class="card-text m-3">{{ apartment.description }}</p>
          </div>

          <div
            class="
              button_details
              p-2
              w-50
              justify-content-center
              align-items-center
              text-center text-white
              m-auto
              mt-4
              mb-4
            "
          >
            <span
              ><a :href="'/guest/apartments/' + apartment.slug"
                >View details</a
              ></span
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Bus } from "../app";
export default {
  data() {
    return {
      map: null,
      apikey: "Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK",
      apartments: [],
      userInput: "",
      n_bed: "",
      n_rooms: "",
      v_services: [],
      distance: null,
      coordinates: {},
    };
  },
  props: {
    services: Array,
    show_route: String,
  },
  methods: {
    searchFunction() {
      // console.log(this.userInput);
      axios
        .get(
          `/api/apartments?n_rooms=${this.n_rooms}&n_bed=${this.n_bed}&services=${this.v_services}&latitude=${this.coordinates.lat}&longitude=${this.coordinates.lon}&distance=${this.distance}`
        )
        .then((response) => {
          this.apartments = response.data.data;
          this.createMap(
            this.apartments[0].longitude,
            this.apartments[0].latitude
          );

          this.addMarker(this.map, this.apartments);

          console.log(this.apartments);
          // console.log(this.n_rooms);
          // console.log(this.n_rooms);
        })
        .catch((error) => {
          console.log(error, "non funziona");
        });
    },
    serviceFunction() {
      // console.log(this.coordinates);
    },

    createMap(lon, lat) {
      const tt = window.tt;
      this.map = tt.map({
        key: this.apikey,
        container: "map",
        center: [lon, lat], // Madrid
        zoom: 9,
        theme: {
          style: "buildings",
          layer: "basic",
          source: "vector",
        },
      });
      this.map.addControl(new tt.FullscreenControl());
      this.map.addControl(new tt.NavigationControl());
    },
    addMarker(map, apartments) {
      const tt = window.tt;
      console.log(apartments);
      apartments.forEach((apartment) => {
        var location = [apartment.longitude, apartment.latitude];
        var popupOffset = 25;

        var marker = new tt.Marker().setLngLat(location).addTo(map);
        var popup = new tt.Popup({
          offset: popupOffset,
          closeOnMove: true,
          maxWidth: "150px",
        }).setHTML(
          `
            <div class=" w-100 m-auto d-flex flex-column">
                <a href="/guest/apartments/${apartment.slug}" class="">
                    <img class=" w-100 mb-2 align-self-center" src="/storage/${apartment.image}" alt="Immagine appartamento">
                </a>
                <p>${apartment.address}</p>
            </div>
          `
        );
        marker.setPopup(popup).togglePopup();
        // console.log(popup);
        // console.log(marker._element);
      });
    },
  },

  created() {
    Bus.$on("sendCoordinates", (data) => {
      this.coordinates = data;
    });
    // console.log(this.coordinates);
    if (localStorage.coordinates) {
      this.coordinates = JSON.parse(localStorage.getItem("coordinates"));
      // console.log(this.coordinates);
    }
  },

  mounted() {
    this.searchFunction();
    // this.createMap();
    // this.addMarker(this.map);
  },
};
/*appunti prima di iniziare

Per soddisfare il fatto che non si deve avere un refresh della pagina della ricerca bisogna fare chiamate delle ajax.
Il metodo più utilizzato in questi casi è fare in modo che ogni cambiamento di input vada a modificare i campi utili alla ricerca nell’url es (/ricerca?tipologia=cinese).
Dopo ogni cambiamento viene fatta una chiamata ajax con i parametri presenti nella URL.
  */
</script>
