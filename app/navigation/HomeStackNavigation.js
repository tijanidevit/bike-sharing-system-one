import React from "react";
import { createStackNavigator } from "@react-navigation/stack";
import { globalConstants } from "../constants";

import DashboardScreen from "../screens/dashboardScreen";
import Article from "../screens/articleScreen";

import { screenOptionStyle } from "./screenOptionStyle";

const Stack = createStackNavigator();

const lightHeader = {
  headerStyle: {
    backgroundColor: globalConstants.SCREEN_BG
  },
  headerTintColor: globalConstants.PRIMARY_COLOR
};
export const HomeStackNavigator = () => {
  return (
    <Stack.Navigator screenOptions={screenOptionStyle}>
      <Stack.Screen
        name="DashboardScreen"
        component={DashboardScreen}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name="Article"
        component={Article}
        options={{
          title: "",
          ...lightHeader
        }}
      />
    </Stack.Navigator>
  );
};
