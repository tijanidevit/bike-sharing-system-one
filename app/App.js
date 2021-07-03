import React, { useState, useEffect } from "react";
import { Alert, StatusBar } from "react-native";
import AppLoading from "expo-app-loading";
import * as Font from "expo-font";
import { Ionicons } from "@expo/vector-icons";
import { setCustomText } from "react-native-global-props";
import { Provider } from "react-redux";
import { store } from "./store/index";
import { MainStackNavigator } from "./navigation";
import * as eva from "@eva-design/eva";
import { ApplicationProvider, IconRegistry } from "@ui-kitten/components";
import { EvaIconsPack } from "@ui-kitten/eva-icons";

const customFonts = {
  montserrat_regular: require("./fonts/Montserrat-Regular.otf"),
  montserrat_medium: require("./fonts/Montserrat-Medium.otf"),
  montserrat_medium_italic: require("./fonts/Montserrat-MediumItalic.otf"),
  montserrat_alternate_bold: require("./fonts/MontserratAlternates-Bold.otf"),
  ...Ionicons.font
};
const customTextProps = {
  style: {
    fontFamily: "montserrat_regular",
    color: "#fff"
  }
};

export default function App() {
  const [fontsLoaded, setFontsLoaded] = useState(false);
  const _loadFontsAsync = async () => {
    await Font.loadAsync(customFonts);
    setFontsLoaded(true);
  };

  useEffect(() => {
    _loadFontsAsync();
  });

  if (fontsLoaded) {
    setCustomText(customTextProps);
    return (
      <Provider store={store}>
        <IconRegistry icons={EvaIconsPack} />
        <ApplicationProvider {...eva} theme={eva.light}>
          <>
            <StatusBar backgroundColor="white" barStyle={"dark-content"} />
            <MainStackNavigator />
          </>
        </ApplicationProvider>
      </Provider>
    );
  } else {
    return (
      <AppLoading
        onError={() => {
          Alert.alert("Opps! Unable to start app.");
        }}
        startAsync={_loadFontsAsync}
        onFinish={() => setFontsLoaded(true)}
      />
    );
  }
}
