import "./bootstrap";

import { createApp } from "vue";
import App from "./App.vue";

const app = createApp(App);

app.mount("#app");

/**
 * @typedef {'home'|'auto'|'recreational-vehicle'} ActiveInsuranceOption
 * @typedef {'lets-get-started'|'personal-info'| 'address-info'} PseudoPage
 */
