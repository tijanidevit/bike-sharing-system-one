import React from "react";
import { Text, Layout, Icon } from "@ui-kitten/components";
import {
  Image,
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback
} from "react-native";
import { globalStyles } from "../../../shared/globalStyles";
import {
  Flexidink,
  loginScreenBg,
  splashScreenBg
} from "../../../shared/generalAssets";
import { globalConstants } from "../../../constants";

const articleList = [
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. ",
    image: splashScreenBg
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. ",
    image: loginScreenBg
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. ",
    image: Flexidink
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. ",
    image: Flexidink
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit. ",
    image: Flexidink
  }
];

export const LatestPost = ({ navigation }) => {
  const viewLandMarkDetails = () => {
    navigation.navigate("Article");
  };
  return (
    <View style={globalStyles.mt30}>
      <Text
        style={[
          globalStyles.fontAltBold,
          globalStyles.textBold,
          styles.heading
        ]}
      >
        Latest Posts
      </Text>
      <ScrollView
        style={{
          height: (30 / 100) * globalConstants.SCREEN_HEIGHT,
          paddingHorizontal: 10
        }}
      >
        {articleList.map((article, index) => (
          <TouchableWithoutFeedback onPress={viewLandMarkDetails} key={index}>
            <Layout
              style={[
                styles.itemBox,
                globalStyles.shadowBox,
                globalStyles.flexRow
              ]}
              level="1"
            >
              <Image source={article.image} style={styles.thumb}></Image>

              <View style={[styles.caption, globalStyles.justifySpaceBetween]}>
                <Text style={[globalStyles.textGray, styles.title]}>
                  {article.name}
                </Text>
                <Text style={styles.small}>15 minutes ago</Text>
              </View>
            </Layout>
          </TouchableWithoutFeedback>
        ))}
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  itemBox: {
    borderRadius: 5,
    marginVertical: 10,
    minHeight: 100,
    paddingVertical: 10
  },
  thumb: {
    width: "30%",
    height: "auto",
    borderRadius: 10
  },
  caption: {
    paddingHorizontal: 10
  },
  title: {
    textAlign: "justify"
  },
  small: {
    fontSize: 11
  },
  heading: {
    borderBottomColor: globalConstants.SECONDARY_COLOR,
    borderBottomWidth: 5,
    fontSize: 20,
    borderRadius: 20
  }
});
