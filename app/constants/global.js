import { Dimensions } from "react-native";

export const globalConstants = {
    PRIMARY_COLOR: "#ca9732",
    SECONDARY_COLOR: "#009631",
    SCREEN_BG: "#fff",
    SCREEN_HEIGHT: Dimensions.get("screen").height,
    SCREEN_WIDTH: Dimensions.get("screen").width,
    USER: "user",
    POST_HEADER: {
        method: "POST"
    },
    GET_HEADER: {
        method: "GET"
    }
};