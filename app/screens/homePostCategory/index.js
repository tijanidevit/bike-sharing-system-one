import React from "react";
import { Layout } from "@ui-kitten/components";
import { SafeAreaView } from "react-native";
import { useDispatch, useSelector } from "react-redux";
import { globalConstants } from "../../constants";
import {
  Categories,
  Header,
  LatestPost,
  TopPost
} from "../../components/PostCategory";
import { globalStyles } from "../../shared/globalStyles";

const HomePostCategory = ({ navigation, route }) => {
  return (
    <SafeAreaView style={{ flex: 1 }}>
      <Layout
        style={[
          globalStyles.containerPadding,
          globalStyles.screenBg,
          { height: globalConstants.SCREEN_HEIGHT }
        ]}
      >
        <Header />
        <Categories
          activeCategoryId={route.params ? route.params.id : 1}
          navigation={navigation}
        />
        <TopPost
          categoryId={route.params ? route.params.id : 1}
          navigation={navigation}
        />
        <LatestPost
          categoryId={route.params ? route.params.id : 1}
          navigation={navigation}
        />
      </Layout>
    </SafeAreaView>
  );
};
export default HomePostCategory;
