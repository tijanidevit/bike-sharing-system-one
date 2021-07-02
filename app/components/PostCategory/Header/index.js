import React from "react";
import { Image, StyleSheet } from "react-native";
import { primaryLogo } from "../../../shared/generalAssets";

export const Header = () => {
  return <Image source={primaryLogo} style={styles.logo} />;
};

const styles = StyleSheet.create({
  logo: {
    maxWidth: 170,
    height: 60
  }
});
