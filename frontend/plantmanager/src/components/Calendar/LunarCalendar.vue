<template>
  <div>
    <div id="ex3"></div>
  </div>
</template>

<script>
export default {
  name: "LunarCalendar",
  data() {
    return {
      configMoon: {
        lang: "ru",
        month: new Date().getMonth() + 1,
        year: new Date().getFullYear(),
        size: "100%",
        lightColor: "white",
        shadeColor: "#000",
        texturize: true,
      },
    };
  },
  methods: {
    load_moon_phases(obj, callback) {
      const gets = [];
      for (const i in obj) {
        gets.push(i + "=" + encodeURIComponent(obj[i]));
      }
      gets.push("LDZ=" + new Date(obj.year, obj.month - 1, 1) / 1000);
      const xmlhttp = new XMLHttpRequest();
      const url = "https://www.icalendar37.net/lunar/api/?" + gets.join("&");
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          callback(JSON.parse(xmlhttp.responseText));
        }
      };
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
    },
    example_3(moon) {
        console.log(moon);
      let lunar_day = 0;
      let i = 0;
      let inc = 0;
      const containsCalendar = document.getElementById("ex3");
      const first_day_week_sunday = false;
      if (first_day_week_sunday) {
        inc = 1;
        moon.nameDay.unshift(moon.nameDay.pop());
      }
      const empty_initial_boxes = Number(moon.phase[1].dayWeek) + inc;

      const number_days_month = Number(moon.daysMonth);

      const total_boxes =
        Math.ceil((empty_initial_boxes + number_days_month) / 7) * 7;

      let html =
        "<div>" +
        '<button value="-1" class="buttonCalendar">\u276E</button>' +
        '<div class="titleCalendar">' +
        moon.monthName +
        " " +
        moon.year +
        "</div>" +
        '<button value="1" class="buttonCalendar">\u276F</button>' +
        "</div>";

      for (i = 0; i < 7; i++) {
        html += '<div class="name_day">' + moon.nameDay[i] + "</div>";
      }

      containsCalendar.innerHTML = html;

      for (i = 0; i < total_boxes; i++) {
        const day = i - empty_initial_boxes;
        const box = document.createElement("DIV");
        box.className = "day_box";
        if (day >= 0 && day < number_days_month) {
          lunar_day = day + 1;
          if (
            moon.year == new Date().getFullYear() &&
            moon.month == new Date().getMonth() + 1 &&
            lunar_day == new Date().getDate()
          ) {
            box.id = "isToDay";
          }

          box.innerHTML =
            "<div>" +
            "<span>" +
            lunar_day +
            "</span>" +
            "<div>" +
            moon.phase[lunar_day].svg +
            "</div>" +
            "</div>";

          if (moon.phase[lunar_day].isPhaseLimit) {
            const url =
              "data:image/svg+xml;utf8, " + moon.phase[lunar_day].svgMini;
            box.firstChild.style.backgroundImage = 'url("' + url + '")';
            box.title = moon.phase[lunar_day].phaseName;
          }
        }
        containsCalendar.appendChild(box);
      }

      document.querySelectorAll(".buttonCalendar").forEach((button) => {
        button.onclick = () => {
          const date_to_show = new Date(
            moon.year,
            moon.month + Number(button.getAttribute("value") - 1),
            1
          );
        //   const configMoon = moon.receivedconstiables;
          this.configMoon.month = date_to_show.getMonth() + 1;
          this.configMoon.year = date_to_show.getFullYear();
          this.render();
          button.style.visibility = "hidden";
        };
      });
    },
    render() {
        this.load_moon_phases(this.configMoon, this.example_3);
    },
  },
  beforeMount() {
    this.render();
  },
};
</script>

<style>
#ex3 {
  max-width: 700px;
  margin: 20px auto;
  background-color: #333333;
  padding: 1%;
  color: white;
  box-sizing: border-box;
  font-family: sans-serif;
}
#isToDay {
  box-shadow: inset 0 0 0 1px darkgray;
}
.day_box,
.name_day,
.titleCalendar,
.buttonCalendar {
  width: calc(100% / 7);
  display: inline-block;
  vertical-align: top;
}
.titleCalendar {
  width: calc(100% / 7 * 5);
  font-size: 24px;
  text-align: center;
}
.buttonCalendar {
  background-color: black;
  text-align: center;
  color: white;
  border: none;
  font-size: 18px;
  padding: 0;
  cursor: pointer;
}
.name_day {
  overflow: hidden;
  font-size: 14px;
  padding: 1px;
  box-sizing: border-box;
  margin-top: 5px;
  text-align: center;
}
.day_box {
  text-align: left !important;
  font-size: 14px;
  background-image: linear-gradient(black, #222222);
  background-size: 97% 97%;
  background-position: center center;
  background-repeat: no-repeat;
}

.day_box > div {
  margin: 1px;
  padding: 5%;
  background-repeat: no-repeat;
  background-size: 25%;
  background-position: 95% 95%;
}
.day_box > div > span {
  position: absolute;
  color: white;
  font-size: 1em;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000,
    1px 1px 0 #000;
}
.day_box > div > div {
  padding: 5% 15%;
}
</style>
