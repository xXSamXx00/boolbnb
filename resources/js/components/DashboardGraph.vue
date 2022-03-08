<template>
  <div>
    <canvas id="myChart"></canvas>
  </div>
</template>

<script>
export default {
  data() {
    return {
      n_aparts_online: this.apartments_online.length,
      n_aparts_offline: this.apartments_offline.length,
    };
  },
  props: ["apartments_online", "apartments_offline"],

  mounted() {
    // console.log(this.n_aparts);
    // console.log(this.n_aparts_online);
    // console.log(this.n_aparts_offline);

    const data = {
      labels: ["Appartamenti privati", "Appartamenti publici"],
      datasets: [
        {
          label: "My First Dataset",
          data: [this.n_aparts_offline, this.n_aparts_online],
          backgroundColor: ["rgb(228, 127, 56)", "rgb(49, 133, 143)"],
          hoverOffset: 4,
        },
      ],
    };

    const config = {
      type: "doughnut",
      data: data,
    };

    const myChart = new Chart(document.getElementById("myChart"), config);
  },
};
</script>

<style>
</style>