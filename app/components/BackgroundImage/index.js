import { ImageBackground } from "react-native";
import React from "react";

const BackgroundImage = (props) => {
  return (
    <ImageBackground
      style={[
        props.style,
        {
          height: props.height ? props.height : "auto",
          width: props.width ? props.width : "auto"
        }
      ]}
      source={props.uri ? { uri: props.uri } : props.source}
    >
      {props.children}
    </ImageBackground>
  );
};

export default BackgroundImage;
