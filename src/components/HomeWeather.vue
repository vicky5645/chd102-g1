<template>
    <section class="weather">

        <div class="rain" v-show="bg_toggle"></div>
        <div class="sunny" v-show="!bg_toggle"></div>
        <div class="today_time_date_loca_wrap">
            <div class="today_time_date_loca" v-if="weather_all_data">
                <div class="today_time">
                    <div class="now_time" id="now_time">
                        {{ current_now_time }} <span id="am_pm">{{ ampm }}</span>
                    </div>
                    <div class="now_date" id="now_date">
                        {{ current_now_date }}
                    </div>
                    <div class="more_info" id="current_weather_items" v-if="weather_all_data.current">
                        <div>當前氣象</div>
                        <!-- <img :src="current_icon_pic"> -->
                        <img :src="get_current_icon(weather_all_data.current.weather[0].icon)">
                        <div class="more_info_detail">
                            <div>體感溫度</div>
                            <div>{{ weather_all_data.current.feels_like }}&#176; C</div>
                        </div>
                        <div class="more_info_detail">
                            <div>濕度</div>
                            <div>{{ weather_all_data.current.humidity }}%RH</div>
                        </div>
                        <div class="more_info_detail">
                            <div>大氣壓</div>
                            <div>{{ weather_all_data.current.pressure }}hPa</div>
                        </div>
                        <div class="more_info_detail">
                            <div>溫度</div>
                            <div>{{ weather_all_data.current.temp }}&#176; C</div>
                        </div>
                        <div class="more_info_detail">
                            <div>紫外線</div>
                            <div>{{ weather_all_data.current.uvi }}UVI</div>
                        </div>
                        <div class="more_info_detail">
                            <div>能見度</div>
                            <div>{{ weather_all_data.current.visibility }}M</div>
                        </div>
                    </div>
                </div>
                <div class="weather_title">行程天氣</div>
                <div class="location_city">
                    <div class="time_zone" id="time_zone">{{ weather_all_data.timezone }}</div>
                </div>

            </div>
        </div>


        <div class="week_weather">
            <div class="today_weather_card" id="today_weather_temp" v-for="(item) in data_daily_filter_result(0)">
                <img :src="get_weather_icon(item, 4)" alt="weather icon" class="w-icon">
                <div class="other_info">
                    <div class="day">{{ get_time_transform(item) }}</div>
                    <div class="temp">溫度 : {{ item.temp.day }}&#176; C</div>
                    <div class="humidity">濕度 :{{ item.humidity }}%RH</div>
                </div>
            </div>

            <div class="week_weather_forecast" id="week_weather_forecast">
                <div class="week_weather_forecast_card" v-for="(item, index) in data_daily_filter_result(1, 7)"
                    :key="index">
                    <div class="day">{{ get_time_transform(item) }}</div>
                    <img :src="get_weather_icon(item, 2)" alt="weather icon" class="w-icon">
                    <div class="temp">溫度 : {{ item.temp.day }}&#176; C</div>
                    <div class="humidity">濕度 : {{ item.humidity }}%RH</div>
                </div>

            </div>
        </div>


    </section>
</template>
<script>

// import * as THREE from 'three';
export default {
    components: {},
    data() {
        return {
            time: new Date(),
            days_arr: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
            months_arr: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            time_zone_data: '',
            API_KEY: '49cc8c821cd2aff9af04c9f98c36eb74',
            humidity_data: '',
            pressure_data: '',
            wind_speed_data: '',

            today: {
                weather_icon_src: 'http://openweathermap.org/img/wn/10d@2x.png',
                day_temp_night: '',
                day_temp_day: '',
                week_index: 0
            },
            weather_all_data: {},
            current_data: {},
            data_daily: [],
            current_icon_pic: '',
            bg_toggle: false,
            get_latitude: 0,
            get_longitude: 0,
        }
    },

    computed: {
        day() {
            return this.time.getDay()
        },
        month() {
            return this.time.getMonth()
        },
        date() {
            return this.time.getDate()
        },
        day() {
            return this.time.getDay()
        },
        hour() {
            return this.time.getHours()
        },
        hours_12hr_format() {
            return this.hour >= 13 ? this.hour % 12 : this.hour
        },
        minutes() {
            return this.time.getMinutes()
        },
        ampm() {
            return this.hour >= 12 ? 'PM' : 'AM'
        },
        current_now_time() {
            return (this.hours_12hr_format < 10 ? '0' + this.hours_12hr_format : this.hours_12hr_format) + ':' + (this.minutes < 10 ? '0' + this.minutes : this.minutes)
        },
        current_now_date() {
            return this.days_arr[this.day] + ', ' + this.date + ' ' + this.months_arr[this.month]
        },
    },

    methods: {

        get_time_transform(item) {
            return this.days_arr[new Date(item.dt * 1000).getDay()]

        },
        data_daily_filter_result(number_start, number_end) {
            return this.data_daily.filter(function (value, index) {
                return number_end ? number_end >= index && index >= number_start : (number_start == 0 ? index == number_start : index >= number_start)
            })
        },

        get_current_icon() {
            return `http://openweathermap.org/img/wn/${this.current_data.weather[0].icon}@4x.png`
        },
        get_weather_icon(item, size) {
            return `http://openweathermap.org/img/wn/${item.weather[0].icon}@${size}x.png`
        },


        get_weather_data() {
            // navigator.geolocation.getCurrentPosition((success) => {
            //     let { latitude, longitude } = success.coords;
            //     this.get_latitude = latitude;
            //     this.get_longitude = longitude;
            // })
            // if (!(this.get_latitude && this.get_longitude)) {
            // }
            this.get_latitude = 24.96296;
            this.get_longitude = 121.1955;
            fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${this.get_latitude}&lon=${this.get_longitude}&exclude=hourly,minutely&units=metric&appid=${this.API_KEY}`).then(res => res.json()).then(data => {
                // console.log(data)
                if (data.current.weather[0].main.toLowerCase().includes("rain")) {
                    this.bg_toggle = true
                } else {
                    this.bg_toggle = false
                }

                this.show_weather_data(data);
            }).catch(error => {
                console.log(error.message)
            })
        },
        show_weather_data(data) {
            this.current_data = data.current;
            this.current_icon_pic = this.get_current_icon();
            this.weather_all_data = data;
            this.data_daily = data.daily;


        }

    },


    mounted() {

        setInterval(() => {
            this.time = new Date();
            this.day
            this.month
            this.date
            this.day
            this.hour
            this.hours_12hr_format
            this.minutes
            this.ampm

        }, 1000);

        this.get_weather_data()


        ///////////threejs

        let scene, camera, renderer, cloudParticles = [], flash, rain, rainGeo, rainCount = 15000;
        let ambient, directionalLight, rainDrop, rainMaterial, cloudGeo, cloudMaterial
        function init() {
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 1, 1000);
            camera.position.z = 1;
            camera.rotation.x = 1.16;
            camera.rotation.y = -0.12;
            camera.rotation.z = 0.27;
            ambient = new THREE.AmbientLight(0x555555);
            scene.add(ambient);

            directionalLight = new THREE.DirectionalLight(0xffeedd);
            directionalLight.position.set(0, 0, 1);
            scene.add(directionalLight);

            flash = new THREE.PointLight(0x062d89, 30, 500, 1.7);
            flash.position.set(200, 300, 100);
            scene.add(flash);

            renderer = new THREE.WebGLRenderer();

            scene.fog = new THREE.FogExp2(0x1c1c2a, 0.002);
            renderer.setClearColor(scene.fog.color);
            renderer.setSize(1920, 1080);
            document.querySelector('.rain').appendChild(renderer.domElement);

            rainGeo = new THREE.Geometry();
            for (let i = 0; i < rainCount; i++) {
                rainDrop = new THREE.Vector3(
                    Math.random() * 400 - 200,
                    Math.random() * 500 - 250,
                    Math.random() * 400 - 200
                );
                rainDrop.velocity = {};
                rainDrop.velocity = 0;
                rainGeo.vertices.push(rainDrop);
            }
            rainMaterial = new THREE.PointsMaterial({
                color: 0xaaaaaa,
                size: 0.1,
                transparent: true
            });
            rain = new THREE.Points(rainGeo, rainMaterial);
            scene.add(rain);
            let loader = new THREE.TextureLoader();
            loader.load(require('@/assets/images/img/index_pic/cloud_01.png'), function (texture) {

                cloudGeo = new THREE.PlaneBufferGeometry(500, 500);
                cloudMaterial = new THREE.MeshLambertMaterial({
                    map: texture,
                    transparent: true
                });

                for (let p = 0; p < 25; p++) {
                    let cloud = new THREE.Mesh(cloudGeo, cloudMaterial)
                    cloud.position.set(
                        Math.random() * 800 - 400, 500,
                        Math.random() * 500 - 450
                    );
                    cloud.rotation.x = 1.16;
                    cloud.rotation.y = -0.12;
                    cloud.rotation.z = Math.random() * 360;
                    cloud.material.opacity = 0.6;
                    cloudParticles.push(cloud)
                    scene.add(cloud);
                }
                // renderer.render(scene, camera);
                animate();
            });



        };


        function animate() {
            cloudParticles.forEach(p => {
                p.rotation.z -= 0.002;
            });
            rainGeo.vertices.forEach(p => {
                p.velocity -= 0.1 + Math.random() * 0.1;
                p.y += p.velocity;
                if (p.y < -200) {
                    p.y = 200;
                    p.velocity = 0;
                }
            })
            rainGeo.verticesNeedUpdate = true;
            rain.rotation.y += 0.002;
            if (Math.random() > 0.93 || flash.power > 100) {
                if (flash.power < 100)
                    flash.position.set(
                        Math.random() * 400,
                        300 + Math.random() * 200, 100

                    );
                flash.power = 50 + Math.random() * 500;
            }
            renderer.render(scene, camera);
            requestAnimationFrame(animate);
        }
        init();



    },
}
</script>
  