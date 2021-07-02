import React, { useState, useEffect } from "react";
import { Text, Layout, Card, Button, ButtonGroup } from "@ui-kitten/components";
import {
  StyleSheet,
  View,
  ScrollView,
  TouchableWithoutFeedback,
  SafeAreaView,
  StatusBar,
  Alert,
  Image
} from "react-native";
import { globalStyles } from "../../shared/globalStyles";
import {
  Flexidink,
  loginScreenBg,
  splashScreenBg
} from "../../shared/generalAssets";
import { globalConstants } from "../../constants";

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

const AboutScreen = ({ navigation, route }) => {
  const [title, setTitle] = useState(route.params ? route.params.title : "");

  useEffect(() => {
    navigation.setOptions({ title: title });
    return () => {};
  }, [title]);
  const showArticles = (id) => {
    navigation.navigate("Article", {
      id
    });
  };
  return (
    <SafeAreaView style={globalStyles.root}>
      <Layout>
        <ScrollView
          style={{
            height: (75 / 100) * globalConstants.SCREEN_HEIGHT,
            paddingHorizontal: 10
          }}
        >
          {articleList.map((article, index) => (
            <TouchableWithoutFeedback
              onPress={() => {
                showArticles(article.id);
              }}
              key={index}
            >
              <Card style={[styles.itemBox, globalStyles.flexRow]}>
                <View
                  style={[styles.caption, globalStyles.justifySpaceBetween]}
                >
                  <Text style={[globalStyles.textGray, styles.title]}>
                    {article.name}
                  </Text>
                  <Text style={styles.small}>15 minutes ago</Text>
                </View>
              </Card>
            </TouchableWithoutFeedback>
          ))}
          <ButtonGroup
            style={styles.buttonGroup}
            appearance="outline"
            status="warning"
          >
            <Button style={styles.pageButton}>1</Button>
            <Button style={styles.pageButton}>2</Button>
            <Button style={styles.pageButton}>3</Button>
            <Button style={styles.pageButton}>4</Button>
            <Button style={styles.pageButton}>5</Button>
            <Button style={styles.pageButton}>6</Button>
            <Button style={styles.pageButton}>7</Button>
            <Button style={styles.pageButton}>8</Button>
          </ButtonGroup>
        </ScrollView>
      </Layout>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  itemBox: {
    marginVertical: 10,
    paddingVertical: 10
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
  buttonGroup: {
    flexWrap: "wrap",
    justifyContent: "center",
    borderWidth: 0,
    marginVertical: 10
  },
  pageButton: {
    marginTop: 5
  }
});

export default AboutScreen;
