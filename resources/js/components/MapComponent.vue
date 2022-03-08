<template>
  <div>
    <div id="map" ref="mapRef" class="col col-4-md"></div>
  </div>
</template>

<script>
export default {
  name: "Map",
  data() {
    return {
      map: null,
      coordinates: [],
      apikey: "Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK",
    };
  },

  props: ["apartment"],

  methods: {
    createMap() {
      const tt = window.tt;
      this.map = tt.map({
        key: this.apikey,
        container: "map",
        center: [this.apartment.longitude, this.apartment.latitude], // Madrid
        zoom: 10,
        theme: {
          style: "buildings",
          layer: "basic",
          source: "vector",
        },
      });
      this.map.addControl(new tt.FullscreenControl());
      this.map.addControl(new tt.NavigationControl());
    },

    addMarker(map) {
      const tt = window.tt;
      var location = [this.apartment.longitude, this.apartment.latitude];
      var popupOffset = 25;

      var marker = new tt.Marker().setLngLat(location).addTo(map);
      var popup = new tt.Popup({ offset: popupOffset }).setHTML(
        `<div class="bg_primary text-white m-auto d-flex flex-column">
            <img class="w-50 mb-2 align-self-center" src="/storage/${this.apartment.image}" alt="Immagine appartamento">
            <p>${this.apartment.title}</p>
            <p>${this.apartment.address}</p>
          </div>`
      );
      marker.setPopup(popup).togglePopup();
      // console.log(popup);
      console.log(marker._element);
      marker._element.innerHTML =
        '<div class="circle rounded-circle text-white bg-dark d-flex p-2 justify-content-center align-items-center"><i class="fas fa-home"></i></div>';

      popup._content.classList.add("bg_primary");
      popup._content.classList.add("col");
    },
  },

  mounted() {
    this.createMap();
    this.addMarker(this.map);

    console.log("component mounted");
    console.log(this.apartment);
  },
};
</script>

<style>
#map {
  height: 500px;
  width: 100%;
}
</style>