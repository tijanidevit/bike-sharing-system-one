import React from "react";
import { createStackNavigator } from "@react-navigation/stack";
import { NavigationContainer } from "@react-navigation/native";
import { globalConstants } from "../constants";

import { screenOptionStyle } from "./screenOptionStyle";
import SplashScreen from "../screens/spashScreen/";
import LoginScreen from "../screens/loginScreen/";
import RegisterScreen from "../screens/RegisterScreen";
import HomeScreen from "../screens/homeScreen/";
// import HomePostCategory from "../screens/homePostCategory";
// import Article from "../screens/articleScreen";
// import About from "../screens/aboutScreen";

const Stack = createStackNavigator();

const primaryHeader = {
    headerStyle: {
      backgroundColor: globalConstants.PRIMARY_COLOR,
      elevation: 0, // remove shadow on Android
      shadowOpacity: 0 // remove shadow on iOS
    },
    headerTintColor: "#fff"
  },
  lightHeader = {
    headerStyle: {
      backgroundColor: globalConstants.SCREEN_BG
    },
    headerTintColor: globalConstants.PRIMARY_COLOR
  };
export const MainStackNavigator = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator screenOptions={screenOptionStyle}>

      <Stack.Screen
          name="HomeScreen"
          component={HomeScreen}
          options={{ headerShown: false }}
        />
        
        <Stack.Screen
          name="SplashScreen"
          component={SplashScreen}
          options={{ headerShown: false }}
        />
<Stack.Screen
          name="LoginScreen"
          component={LoginScreen}
          options={{ headerShown: false }}
        />

<Stack.Screen
          name="RegisterScreen"
          component={RegisterScreen}
          options={{ headerShown: false }}
        />


        {/* 

        

       

        <Stack.Screen
          name="HomePostCategory"
          component={HomePostCategory}
          options={{ headerShown: false }}
        />

        <Stack.Screen
          name="Article"
          component={Article}
          options={{ headerShown: false }}
        />

        <Stack.Screen
          name="About"
          component={About}
          options={{
            title: "About ",
            ...lightHeader
          }}
        /> */}
      </Stack.Navigator>
    </NavigationContainer>
  );
};
