import React from "react";
import { createStackNavigator } from "@react-navigation/stack";
import { globalConstants } from "../constants";

import { screenOptionStyle } from "./screenOptionStyle";
import Article from "../screens/articleScreen";
import GistCategory from "../screens/gistCategory";
import GistCategoryArticles from "../screens/gistCategoryArticles";

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
export const GistStackNavigator = () => {
  return (
    <Stack.Navigator screenOptions={screenOptionStyle}>
      <Stack.Screen
        name="GistCategory"
        component={GistCategory}
        options={{ headerShown: false }}
      />
      <Stack.Screen
        name="GistCategoryArticles"
        component={GistCategoryArticles}
        options={{
          title: "",
          ...lightHeader
        }}
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
