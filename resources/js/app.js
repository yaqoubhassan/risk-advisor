import {createApp} from "vue";
import {createRouter, createWebHistory} from "vue-router";
import "../css/app.css";
import App from "./App.vue";
import Home from "./routes/index.vue";
import PersonalInformation from "./routes/personal-information.vue";
import AddressInformation from "./routes/address-information.vue";
import Success from "./routes/success.vue";
import "./bootstrap";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: "/", component: Home},
        {path: "/personal-information", component: PersonalInformation},
        {path: "/address-information", component: AddressInformation},
        {path: "/success", component: Success},
    ],
});

const app = createApp(App);

app.use(router);

app.mount("#app");

/**
 * @typedef {'home'|'auto'|'recreational-vehicle'} ActiveInsuranceOption
 * @typedef {'lets-get-started'|'personal-info'| 'address-info'} PseudoPage
 */
