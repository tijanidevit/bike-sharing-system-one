import React from "react";
import { Text, Layout } from "@ui-kitten/components";
import {
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback
} from "react-native";
import { globalStyles } from "../../../shared/globalStyles";
import { Flexidink } from "../../../shared/generalAssets";
import { globalConstants } from "../../../constants";

const categoryList = [
  { id: 1, name: "News", image: Flexidink },
  { id: 2, name: "Sport", image: Flexidink },
  { id: 3, name: "Programming", image: Flexidink },
  { id: 4, name: "Competition", image: Flexidink },
  { id: 5, name: "Others", image: Flexidink }
];

export const Categories = ({ navigation, activeCategoryId }) => {
  const changeCategory = (id) => {
    navigation.navigate("PostCategory", {
      id
    });
  };
  return (
    <View>
      <ScrollView
        horizontal={true}
        showsHorizontalScrollIndicator={false}
        scrollEventThrottle={200}
        decelerationRate="fast"
        style={styles.scrollView}
      >
        {categoryList.map((category, index) => (
          <TouchableWithoutFeedback
            onPress={() => {
              changeCategory(category.id);
            }}
            key={index}
          >
            <Layout
              style={[
                styles.tab,
                globalStyles.flexRow,
                globalStyles.alignCenter,
                activeCategoryId === category.id ? styles.active : null
              ]}
              level="3"
            >
              <Text>{category.name}</Text>
            </Layout>
          </TouchableWithoutFeedback>
        ))}
      </ScrollView>
    </View>
  );
};

const styles = StyleSheet.create({
  scrollView: {
    padding: 10
  },
  tab: {
    padding: 10,
    borderRadius: 5,
    width: "auto",
    marginRight: 20
  },
  active: {
    borderBottomColor: globalConstants.SECONDARY_COLOR,
    borderBottomWidth: 5
  }
});
