// import axios
import axios from "axios";

const Api = axios.create({
    // API URL
    baseURL: "http://localhost:8000",
});

export default Api;
