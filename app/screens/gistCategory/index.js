import React from "react";
import { Text, Layout, Card } from "@ui-kitten/components";
import {
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback,
  SafeAreaView,
  Alert
} from "react-native";
import { globalStyles } from "../../shared/globalStyles";
import { Flexidink } from "../../shared/generalAssets";
import { globalConstants } from "../../constants";
import { TouchableOpacity } from "react-native-gesture-handler";

const categoryList = [
  { id: 1, name: "News", image: Flexidink },
  { id: 2, name: "Sport", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 4, name: "Competition", image: Flexidink },
  { id: 5, name: "Others", image: Flexidink }
];

const GistCategory = ({ navigation, activeCategoryId }) => {
  const showArticles = (category) => {
    navigation.navigate("GistCategoryArticles", {
      id: category.id,
      title: category.name
    });
  };
  return (
    <SafeAreaView style={globalStyles.root}>
      <Layout>
        <Text
          style={[
            globalStyles.fontAltBold,
            globalStyles.textBold,
            styles.heading
          ]}
        >
          Categories
        </Text>
        <ScrollView
          scrollEventThrottle={200}
          decelerationRate="fast"
          // style={styles.scrollView}
        >
          {categoryList.map((category, index) => (
            <TouchableOpacity
              onPress={() => {
                showArticles(category);
              }}
              key={index}
            >
              <Card>
                <Layout
                  style={[
                    styles.tab,
                    globalStyles.flexRow,
                    globalStyles.alignCenter,
                    globalStyles.justifySpaceBetween,
                    activeCategoryId === category.id ? styles.active : null
                  ]}
                  level="3"
                >
                  <Text>{category.name}</Text>
                  <Text style={[globalStyles.textSmall, styles.postCount]}>
                    402234234
                  </Text>
                </Layout>
              </Card>
            </TouchableOpacity>
          ))}
        </ScrollView>
      </Layout>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  tab: {
    padding: 10,
    borderRadius: 5,
    width: "auto"
  },
  active: {
    borderBottomColor: globalConstants.SECONDARY_COLOR,
    borderBottomWidth: 5
  },
  heading: {
    borderBottomColor: globalConstants.SECONDARY_COLOR,
    borderBottomWidth: 5,
    fontSize: 20,
    borderRadius: 20,
    paddingHorizontal: 30,
    marginTop: 30
  },
  postCount: {
    backgroundColor: globalConstants.PRIMARY_COLOR,
    color: "#fff",
    borderRadius: 10,
    padding: 3
  }
});

export default GistCategory;
