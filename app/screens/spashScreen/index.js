import React from "react";
import { StyleSheet, View, SafeAreaView, Image } from "react-native";
import { globalStyles } from "../../shared/globalStyles";
import { globalConstants } from "../../constants";
import { animBikeOne, animatedLogo } from "../../shared/generalAssets";
import { Layout, Text, Button, Icon } from "@ui-kitten/components";

const arrowIcon = (props) => <Icon {...props} name="arrowhead-right-outline" />;

const SplashScreen = ({ navigation }) => {
  return (
    <SafeAreaView
      style={[
        globalStyles.screenBg,
        globalStyles.root,
        {
          height: globalConstants.SCREEN_HEIGHT
        }
      ]}
    >
      <Layout
        style={[
          globalStyles.centerCenter,
          {
            flex: 1
          }
        ]}
      >
        <Image source={animBikeOne} style={styles.animBikeOne} />
        <View>
          <Text
            style={[
              globalStyles.textDark,
              globalStyles.fontAltBold,
              globalStyles.textSmall
            ]}
          >
            Your campus ride got easier
          </Text>
          <View style={globalStyles.flexRow}>
          <Button
            onPress={() => {
              navigation.navigate("HomeScreen");
            }}
            size="tiny"
            style={[
              globalStyles.mt30,
              globalStyles.bgPrimary,
              globalStyles.noBorder,
              globalStyles.mr20
            ]}
          >
            <Text style={globalStyles.textWhite}>Login</Text>
          </Button>
          <Button
            onPress={() => {
              navigation.navigate("RegisterScreen");
            }}
            size="tiny"
            style={[
              globalStyles.mt30,
              globalStyles.bgPrimary,
              globalStyles.noBorder
            ]}
          >
            <Text style={globalStyles.textWhite}>Register</Text>
          </Button>
          </View>
        </View>
      </Layout>
    </SafeAreaView>
  );
};

export default SplashScreen;

const styles = StyleSheet.create({
  animBikeOne: {
    maxWidth: (globalConstants.SCREEN_WIDTH * 70) / 100,
    height: 200
  }
});
