import { Dimensions } from "react-native";
export const FLUTTER_WAVE_SECRET_KEY =
  "FLWSECK_TEST-158941a951db2840b1e782661de42007-X";

export const globalConstants = {
  PRIMARY_COLOR: "#ca9732",
  SECONDARY_COLOR: "#009631",
  SCREEN_BG: "#fff",
  SCREEN_HEIGHT: Dimensions.get("screen").height,
  SCREEN_WIDTH: Dimensions.get("screen").width,
  USER: "user",
  POST_FETCH_HEADER: {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json"
    }
  },
  FLUTTERWAVE_FETCH_HEADER: {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${FLUTTER_WAVE_SECRET_KEY}`
    }
  },
  FLUTTERWAVE_POST_HEADER: {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      Authorization: `Bearer ${FLUTTER_WAVE_SECRET_KEY}`
    }
  }
};
