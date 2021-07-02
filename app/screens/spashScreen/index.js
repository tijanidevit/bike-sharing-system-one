import React from "react";
import { StyleSheet, View, SafeAreaView, Image } from "react-native";
import { globalStyles } from "../../shared/globalStyles";
import { globalConstants } from "../../constants";
import { altAnimatedLogo, animatedLogo } from "../../shared/generalAssets";
import { Layout, Text, Button, Icon } from "@ui-kitten/components";

const StarIcon = (props) => <Icon {...props} name="arrowhead-right-outline" />;

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
        <Image source={altAnimatedLogo} style={styles.logo} />
        <View>
          <Text
            style={[
              globalStyles.textDark,
              globalStyles.fontAltBold,
              globalStyles.textSmall
            ]}
          >
            All Gists in One Place
          </Text>
          <Button
            onPress={() => {
              navigation.navigate("HomeScreen");
            }}
            accessoryRight={StarIcon}
            size="tiny"
            style={[
              globalStyles.mt30,
              globalStyles.bgPrimary,
              globalStyles.noBorder
            ]}
          >
            <Text style={globalStyles.textWhite}>Continue</Text>
          </Button>
        </View>
      </Layout>
    </SafeAreaView>
  );
};

export default SplashScreen;

const styles = StyleSheet.create({
  logo: {
    maxWidth: (globalConstants.SCREEN_WIDTH * 70) / 100,
    height: 100
  }
});
