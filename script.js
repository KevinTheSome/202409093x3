const wetherHtml = document.getElementById("wether");

const API = "https://api.open-meteo.com/v1/forecast?latitude=57.3&longitude=25.26&current=temperature_2m,relative_humidity_2m,apparent_temperature,is_day,precipitation,rain,showers,snowfall,weather_code,cloud_cover,wind_speed_10m,wind_direction_10m,wind_gusts_10m&timezone=auto";

async function getData() {

  try {
    const response = await fetch(API);
    if (!response.ok) {
      console.error("Something went wrong" + response.status.toString());
    }

    const json = await response.json();
    console.log(json);
    wetherHtml.innerHTML =  "Latvija Cēsis " + json.current.wind_speed_10m + "Km/h " + json.current.temperature_2m + "°C";
  } catch (error) {
    console.error(error.message);
  }
}

getData();


function spin() {
    const body = document.getElementById("body")
    if (body.classList.contains("spin")) {
        body.classList.add("spin2")
    }

    body.classList.add("spin")

}  




