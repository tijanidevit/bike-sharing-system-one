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

const articles = [
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: splashScreenBg
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: loginScreenBg
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: Flexidink
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: Flexidink
  },
  {
    name: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
    image: Flexidink
  }
];

export const TopPost = ({ navigation, categoryId }) => {
  const viewLandMarkDetails = () => {
    navigation.navigate("Article");
  };
  return (
    <View>
      <ScrollView
        horizontal={true}
        showsHorizontalScrollIndicator={false}
        scrollEventThrottle={200}
        decelerationRate="fast"
      >
        {articles.map((article, index) => (
          <TouchableWithoutFeedback onPress={viewLandMarkDetails} key={index}>
            <Layout style={[styles.itemBox, globalStyles.shadowBox]} level="2">
              <Image source={article.image} style={styles.thumb}></Image>
              <View
                style={[
                  globalStyles.flexRow,
                  globalStyles.justifySpaceBetween,
                  styles.misc
                ]}
              >
                <Text style={globalStyles.textSmall}>2 hours ago</Text>
                <View
                  style={[
                    globalStyles.flexRow,
                    globalStyles.centerCenter,
                    { width: "20%" }
                  ]}
                >
                  <Icon style={styles.icon} fill="#8F9BB3" name="eye-outline" />
                  <Text style={[globalStyles.textGray, globalStyles.textSmall]}>
                    20
                  </Text>
                </View>
              </View>
              <View style={[styles.caption]}>
                <Text
                  article="h6"
                  style={[globalStyles.textGray, styles.title]}
                >
                  {article.name}
                </Text>
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
    width: (75 / 100) * globalConstants.SCREEN_WIDTH,
    marginRight: 20,
    marginVertical: 10
  },
  thumb: {
    width: "100%",
    height: 150
  },
  caption: {
    padding: 10
  },
  icon: {
    height: 15,
    width: 15
  },
  misc: {
    position: "absolute",
    top: 10,
    width: "100%",
    paddingHorizontal: 10
  }
});
